<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\MyPermissionCounter;
use App\Models\DoorSchedule;
use App\Models\MyPermission;
use App\Models\DoorScheduleCounter;
use App\Models\DoorSchedulePermission;
use App\Models\Unit;
use App\Models\Door;
use App\Models\DoorIp;
use App\Models\DoorStatusSetter;
use App\Models\DoorStatus;
use App\Models\DoorScheduleDoor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $door_id)
    {
        //
        $clientIp= $request->ip();
        $ip_details = DoorIp::select('ip_address')
        ->where('door_id', $door_id)
        ->first();
        $ip_address = $ip_details['ip_address'] ;
        if($ip_address != $clientIp){
            DoorIp::where('door_id', $door_id)
            ->update(['ip_address'=>$clientIp]);
        }
        $door_status = DoorStatus::select('status')
                                ->where('door_id', $door_id)
                                ->first();
        if($door_status['status']==='Locked'){
            return response()->json(1);
        }
        else if($door_status['status']==='Unlocked'){
            return response()->json(0);
        }
    }

    public function doorStatus($status){
            if($status===true) {
                    $pinURL = "http://192.168.137.43/?led_2_on";}
            else if($status===false){
                $pinURL = "http://192.168.137.43/?led_2_off";
            }
            else if($status===null){
                $pinURL = "http://192.168.137.43/?led_2_auth";
            }
            // Initialize cURL session
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $pinURL);  // Set the URL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string

            // Execute cURL request
            $response = curl_exec($ch);

            // Check for errors
            if($response === false) {
                echo 'Curl error: ' . curl_error($ch);
            } else {
                // Output the response
                echo $response;
            }

            // Close cURL session
            curl_close($ch);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $encoded_permission_id)
    {
        $passed_permission_id=base64_decode($encoded_permission_id);
        $my_permissions= MyPermission::where('id', $passed_permission_id)->first();
        $unit_id= $my_permissions['unit_id'];
        if($request->isMethod('get')){
            $unit= unit::find($unit_id);
             $doors= Door::where('unit_id', $unit_id)
                             ->get();
             $permission_groups=DoorSchedulePermission::where('user_id',Auth::id())
                                                       ->select('id','permission_name')
                                                        ->get();
                                                      //  dd($permission_groups);
            return view('add_schedule' , [
                'doors'=>  $doors,
                'unit'=> $unit,
                'permission_groups'=>  $permission_groups,
                'encoded_permission_id' =>  $encoded_permission_id
                   ]);

        }
        else{
         $schedules = $request->all();
        $permissioner_permissions = MyPermission::leftjoin('permissions','my_permissions.permission_group_id','=','permissions.permission_group_id')
        -> where('my_permissions.id', $passed_permission_id)
       ->first();
        $start_date= Carbon::parse($schedules['start_date']);
        $end_date= Carbon::parse($schedules['end_date']);
        $permissioner_permission_end_date= Carbon::parse($permissioner_permissions['end_date']);
        $permissioner_permission_start_date= Carbon::parse($permissioner_permissions['start_date']);
      // dd($schedules);
      if( $permissioner_permissions['schedule']==='no'){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, You are not allowed to active the door access button'
        );   
    }
    else if($permissioner_permission_start_date->gt($start_date)){
        $notification = array(
             'alert-type' => 'error',
             'message' => 'Ooops!!!, Start time must be greater than your assigned start date'
         );     
    }

    else if($permissioner_permission_end_date->lt($end_date)){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, End time must be less than your assigned end date '
        );     
    }

   else{
   
         DB::beginTransaction();
         try{
        if($schedules['permission_group']==='create_new'){
       
        $create_permissions =DoorSchedulePermission::create([
            //'permission_name' => Auth::id().'_P#name_'.$schedules['permission_group_name'],
            'permission_name' => $schedules['permission_group_name'],
            'open_in' =>  $schedules['open_in'],
            'close_in' =>  $schedules['close_in'],
            'open_out' =>  $schedules['open_out'],
            'close_out' =>  $schedules['close_out'],
           'open_in_fre' =>  $schedules['open_in_fre'],
           'close_in_fre' =>  $schedules['close_in_fre'],
           'open_out_fre' =>  $schedules['open_out_fre'],
           'close_out_fre' =>  $schedules['close_out_fre'],
           'user_id' =>  Auth::id(),
          
        ]);
        $door_schedule_id=  $create_permissions['id'];
    }else{
        $door_schedule_id=  $schedules['permission_group_id'];  
    }

$schedule_create= DoorSchedule::create([
    'start_date' => $schedules['start_date'],
    'end_date' =>  $schedules['end_date'],
    'user_id' =>  Auth::id(),
    'door_schedule_permission_id' =>  $door_schedule_id,
   
]);

foreach ($schedules as $door_name_ => $door_id) {
    if (strpos($door_name_, 'door_id_') !== false) {
        $permissioner_permissions_counters= MyPermissionCounter::where('my_permission_id', $passed_permission_id)
        ->where('door_id', $door_id)
                            ->first();
        $door_name = Door::where('id', $door_id)
        ->select('door_name')
        ->first();
       
        //dd( $permissioner_permissions_counters);
        $permissioner_permissions_count= $permissioner_permissions_counters['schedule'];

        if($permissioner_permissions_count >= $permissioner_permissions['schedule_fre']){
        $notification = array(
        'alert-type' => 'error',
        'message' => 'Ooops!!!, You have exhausted your permissions on door' .$door_name 
        );       
        }else{
       $door_schedule_door = DoorScheduleDoor::create(
            [
                'door_schedule_id' => $schedule_create['id'],
                'door_id' => $door_id,
            ]);
        DoorScheduleCounter::create([
            'door_schedule_door_id' => $door_schedule_door['id'],
            'open_in' => 0,
            'open_out' => 0,
            'close_in' => 0,
            'close_out' => 0,
                            
        ]);
        MyPermissionCounter::where('my_permission_id' ,$passed_permission_id)
        ->where('door_id', $door_id)
        ->update([
            'schedule' => $permissioner_permissions_count + 1,
        ]);
    }
}
}
  DB::commit();
$notification = array(
    'alert-type' => 'success',
    'message' => 'Door activation schedule set successfully');
    
       
        
}
       
  catch (\Exception $e) {
        DB::rollback();
        $notification = array(
           'alert-type' => 'error',
           'message' => 'Oooops!! an error occurred please try again later'
        );
     } 


}
return redirect()->back()->with($notification);
}
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $door_id, $action)
    {
        $clientIp= $request->ip();
        $ip_details = DoorIp::select('*')
        ->where('door_id', $door_id)
        ->first();
        $ip_address = $ip_details['ip_address'];
        if($ip_address != $clientIp){
            DoorIp::where('id',$ip_details['id'])
            ->update(['ip_address'=>$clientIp]);
        }
        $button_requests = DoorSchedule::leftJoin('door_schedule_permissions', 'door_schedules.door_schedule_permission_id', '=', 'door_schedule_permissions.id')
                                        ->leftJoin('door_schedule_doors', 'door_schedules.id', '=', 'door_schedule_doors.door_schedule_id')
                                        ->select('door_schedule_permissions.*', 'door_schedule_doors.id as door_schedule_door_id')
                                        ->where('door_schedule_doors.door_id', $door_id)
                                        ->where('door_schedules.end_date', '>', Carbon::now())
                                        ->orderBy('door_schedules.created_at', 'desc')
                                        ->first();
        $door_status  = DoorStatus::select('status')
                                    ->where('door_id', $door_id)
                                    ->first(); 
        $door_status= $door_status['status'];
        // dd($door_status)  ;                                     
        if($button_requests===null||empty($button_requests)){
            
            $response_status = 2; 
        }
        else{
        $button_request_counters= DoorScheduleCounter::select('door_schedule_counters.*')
                                                    ->where('door_schedule_door_id', $button_requests['door_schedule_door_id'])
                                                     ->first();
        //dd($button_request_counters);
        if($action === 'openOut'){
            if($door_status==='Unlocked'){
                $response_status = 0;
            }
           else if($button_requests['open_out']=== 'no'|| $button_requests['open_out_fre']<= $button_request_counters['open_out']){
               
                 $response_status = 2;
            }
            else{
            DB::beginTransaction();
            try{
              DoorScheduleCounter::where('door_schedule_door_id', $button_requests['door_schedule_door_id'])
                                        ->update(['open_out'=>$button_request_counters['open_out']+1,]);
              DoorStatus::where('door_id', $door_id)
                            ->update(['status'=>'Unlocked',
                            'status_setter'=>1000,
                 ]);
              DoorStatusSetter::create([
                'door_id'=> $door_id,
                'status' => 'Unlocked',
                'user_id'=> 1000
                ]) ;
                DB::commit();
                $response_status = 0;
                }
                catch (\Exception $e) {
                DB::rollback();
                $response_status = 2;
                            }
                        }
         }
        if($action === 'openIn'){
            if($door_status==='Unlocked'){
                $response_status = 0;
            }
            else if($button_requests['open_in'] === 'no'||$button_requests['open_in_fre']<= $button_request_counters['open_in']){
                $response_status = 2; 
            }
            else{
             DB::beginTransaction();
             try{
              DoorScheduleCounter::where('door_schedule_door_id', $button_requests['door_schedule_door_id'])
                                        ->update(['open_in'=>$button_request_counters['open_in']+1,]);
              DoorStatus::where('door_id', $door_id)
                            ->update(['status'=>'Unlocked',
                            'status_setter'=>1000,
                 ]);
              DoorStatusSetter::create([
                'door_id'=> $door_id,
                'status' => 'Unlocked',
                'user_id'=> 1000
                ]) ;
                
                DB::commit();
               
               $response_status = 0;
                }
                catch (\Exception $e) {
                DB::rollback();
                $response_status = 2;
                            }
                        } 
            }
        
        if($action === 'closeOut'){
            if($door_status=== 'Locked'){
                $response_status = 1;
            }
            else if($button_requests['close_out']==='no'|| $button_requests['close_out_fre']<= $button_request_counters['close_out']){
                $response_status = 2; 
            }
            else{
                DB::beginTransaction();
                try{
                  
                  DoorScheduleCounter::where('door_schedule_door_id', $button_requests['door_schedule_door_id'])
                                        ->update(['close_out'=>$button_request_counters['close_out']+1,]);
                  DoorStatus::where('door_id', $door_id)
                                ->update(['status'=>'Locked',
                                'status_setter'=>1000,
                     ]);
                  DoorStatusSetter::create([
                    'door_id'=> $door_id,
                    'status' => 'Locked',
                    'user_id'=> 1000
                    ]) ;
                   
                    DB::commit();
                    $response_status = 1;
                    }
                    catch (\Exception $e) {
                    DB::rollback();
                    $response_status = 2;
                                }
                            }
            }
        
        if($action === 'closeIn'){
            if($door_status === 'Locked'){
                $response_status = 1;
            }
            else if($button_requests['close_in']=== 'no'|| $button_requests['close_in_fre']<= $button_request_counters['close_in']){
            //    $this->doorStatus(null);
               $response_status = 2;
            }
            else{
                DB::beginTransaction();
                try{
                  DoorScheduleCounter::where('door_schedule_door_id', $button_requests['door_schedule_door_id'])
                                        ->update(['close_in'=>$button_request_counters['close_in']+1,]);
                  DoorStatus::where('door_id', $door_id)
                                ->update(['status'=>'Locked',
                                'status_setter'=>1000,
                     ]);
                  DoorStatusSetter::create([
                    'door_id'=> $door_id,
                    'status' => 'Locked',
                    'user_id'=> 1000
                    ]) ;

                    DB::commit();
                    
                    $response_status = 1;

                    }
                    catch (\Exception $e) {
                    DB::rollback();
                    $response_status = 2;
                                }
                            }
            }
        }
        return response()->json($response_status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
