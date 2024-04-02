<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;
use App\Models\Door;
use App\Models\DoorIp;
use App\Models\DoorScheduleDoor;
use App\Models\DoorSchedule;
use App\Models\User;
use App\Models\DoorStatus;
use App\Models\MyPermission;
use App\Models\MyPermissionCounter;
use App\Models\MyPermissionDoor;
use Carbon\Carbon;
use DB;
use DataTables;
use Illuminate\Support\Facades\Http;
class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $rooms = Unit::leftjoin('users','units.owner_id','users.id')
                        ->select('units.*', 'users.fname', 'users.lname')
                        ->orderBy('units.premises_name', 'asc')
                        ->get();
        return view('adminstration::rooms.index',['rooms'=> $rooms]);
    }
    public function roomUpdate($unit_id){
       $unit_id = base64_decode($unit_id);
            {$room_detail = Unit::leftjoin('users','units.owner_id','users.id')
                            ->select('units.*',  'users.fname', 'users.lname','users.phone',)
                            ->where('units.id',$unit_id)
                            ->first();
        return view('adminstration::rooms.edit_room',['room_detail'=> $room_detail]);}
       
                }
            
    /**
     * Show the form for creating a new resource.
     */
    public function roomUpdateAction(Request $request){
            $unit_details = $request->all();
            DB::beginTransaction();
            try{
                $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$unit_details['latitude'].','.$unit_details['longitude']."&sensor=true&key=".env('GOOGLE_MAPS_API_KEY');
                $dd=file_get_contents($url);
                $dd=json_decode($dd);
                $google_pin_location= $dd->results[0]->formatted_address;
            $units =Unit::where('id',$unit_details['unit_id'])
                          ->update([
                            'unit_name' => $unit_details['unit_name'],
                            'owner_id' =>   $unit_details['owner_id'],
                            'premises_name' => $unit_details['premises_name'],
                            'longitude'    =>  $unit_details['longitude'],
                            'latitude'  =>$unit_details['latitude'],
                            'google_location'  =>$google_pin_location,
                                            ]); 
                
                    DB::commit();
                $notification = array(
                    'message'    => 'Room details updated succesful',
                    'alert-type' => 'success',
                );
                
                
                    
                
                    }    
                    
                    catch (\Exception $e) {
                        DB::rollback();
                        $notification = array(
                            'message'    => $e,
                            //'Ooops!! an error occurred while processing your request.',
                            'alert-type' => 'error',
                );
                    } 
                    return redirect()->route('rooms.index')->with($notification);
                   
                }
    public function create(Request $request)
    {  
        $unit_details = $request->all();
       
       //dd($unit_details);
        DB::beginTransaction();
        try{
            $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$unit_details['latitude'].','.$unit_details['longitude']."&sensor=true&key=".env('GOOGLE_MAPS_API_KEY');
            $dd=file_get_contents($url);
            $dd=json_decode($dd);
            $google_pin_location= $dd->results[0]->formatted_address;
        $units =Unit::create([
            'unit_name' => $unit_details['unit_name'],
            'owner_id' =>   $unit_details['owner_id'],
            'premises_name' => $unit_details['premises_name'],
            'longitude'    =>  $unit_details['longitude'],
            'latitude'  =>$unit_details['latitude'],
            'google_location'  =>$google_pin_location,
            'doors' => $unit_details['doors']
        ]);
        $my_permissions =MyPermission::create([
            'user_id' => $unit_details['owner_id'],
           // 'door_id' => $permission['door_id'],
            'permission_group_id' => 1000,
            'permissioner_id' => 1001 ,
             'unit_id'       =>  $units['id'],
            'start_date' => Carbon::now() ,
            'end_date' =>  Carbon::now()->copy()->endOfYear(),
            //'end_date' =>  Carbon::parse($permissions['end_date'])->toW3cString(),
        ]);
        
        for ($i = 0; $i < $unit_details['doors']; $i++) {
            $door_name_variable = 'door_name_' . $i;
            $door_names = $unit_details[$door_name_variable];
        //dd($unit_details);
            $door =Door::create([
                'door_name' => $door_names,
                'unit_id' => $units['id'],
            ]);

            DoorIp::create([
                'door_id' =>  $door['id'],
                'door_ip_status' => 'Inactive',
            ]);

            MyPermissionCounter::create([
                'my_permission_id' => $my_permissions['id'],
                'door_id'  => $door['id'],
                'give_permission' => 0,
                'open' => 0,
                'close' => 0,
                'schedule' =>0,
                ]);
            MyPermissionDoor::create(
                    [
                        'my_permission_id' => $my_permissions['id'],
                        'door_id' => $door['id'],
                    
                    ]);
            DoorStatus::create(
                [   
                    'door_id' => $door['id'],
                    'status' => 'Unlocked',
                    'status_setter' => '1001',
                
                ]);        
                
        }
    
    DB::commit();
  $notification = array(
    'message'    => 'unit regestration succesful',
    'alert-type' => 'success',
);


       

       }
       
     catch (\Exception $e) {
        DB::rollback();
        $notification =array(
                            'message'    => 'Ooops!! an error occurred while processing your request.',
                            'alert-type' => 'error',
                );
        } 
    //return response()->json($notification);
    return redirect()->back()->with($notification);
   
    }

    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Show the specified resource.
     */
    public function show()
    {  
         
        return view('adminstration::rooms.add_unit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('adminstration::edit');
    }
    Public function doors( $unit_id){
        $unit_id= base64_decode($unit_id);
        $doors = Door::LeftJoin('door_ips','doors.id','=','door_ips.door_id')
                     ->select('door_ips.*','doors.door_name')
                     ->where('doors.unit_id', $unit_id)
                     ->get();
                return view('adminstration::rooms.doors',['doors'=> $doors]);      
    }
    /**
     * Update the specified resource in storage.
     */
    public function doors_edit_blade($door_id){
        $door_id= base64_decode($door_id);
        $door_details = Door::LeftJoin('door_ips','doors.id','=','door_ips.door_id')
        ->select('door_ips.*','doors.door_name')
        ->where('doors.id', $door_id)
        ->first();
        
        return view('adminstration::rooms.door_edit',['door_details'=>$door_details,
                            //    'encoded_permission_id'=> $encoded_permission_id
                        ]);
    }
     public function doors_edit(Request $request){

        $ip_details = $request-> all();
        $unit_id = Door::select('unit_id')
                        ->where('id', $ip_details['door_id'])
                        ->first();
        $unit_id= $unit_id['unit_id'];
        DB::beginTransaction();
        try{
             $update_ip= Door::leftJoin('door_ips','doors.id','=','door_ips.door_id')
                            ->where('door_id', $ip_details['door_id'])
                            ->update([
                                'door_name'=>  $ip_details['door_name'],
                                'ip_address'=>  $ip_details['ip_address'],
                                'door_ip_status'=>  $ip_details['door_ip_status'],
                                ]);
            DB::commit();
            $notification = array(
            'message'    => 'Door details updated are succesful',
            'alert-type' => 'success',
        ); }
                    
                    catch (\Exception $e) {
                    DB::rollback();
                    if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
                        $notification =array(
                                    'message'    => 'Ooops!! The Ip Address Already Exists',
                                    'alert-type' => 'error',
                                         );
                    } else {
                        $notification =array(
                            'message'    => 'Ooops!! an error occurred while processing your request.',
                            'alert-type' => 'error',
                );
                    }
                   
        } 
       
        return redirect()->route('rooms.doors', ['id' => base64_encode($unit_id)])->with($notification);
    
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
   {  $unit_id = $request->all();
        $unit_id=$unit_id['unit_id'];
     DB::beginTransaction();
        try{

         $active_permissions =  MyPermission::where('my_permissions.unit_id', $unit_id)
                        ->where('my_permissions.end_date', '>', Carbon::now())
                        ->get();
         foreach($active_permissions as $active_permission) {
                    MyPermissionDoor::where('my_permission_id',$active_permission['id'])
                                                    ->delete();
               
                     MyPermission::where('id','=',$active_permission['id'])
                                    ->delete();
         }              
            $active_schedules = DoorSchedule::where('door_schedules.unit_id', $unit_id)
                                            ->where('door_schedules.end_date', '>', Carbon::now())
                                            ->get();
                foreach($active_schedules as $active_schedule){
                    
                        DoorScheduleDoor::where('door_schedule_id',$active_schedule['id'])
                                        ->delete();
                        DoorSchedule::where('id',$active_schedule['id'])
                                        ->delete();                    
                }

            $doors=  Door::where('doors.unit_id', $unit_id)
                            ->get();
                    foreach($doors as $door){
                           DoorIp::where('door_id',$door['id'])
                                            ->delete();
                            DoorStatus::where('door_id',$door['id'])
                                            ->delete();
                                            $door=Door::where('id',$door['id'])
                                            ->delete();
                    }           
                Unit::where('id', $unit_id)
                    ->delete();

                DB::commit();
            $notification = array(
                'alert-type' => 'success',
                'message' => 'Unit has been successfully deleted');
        }
       
                catch (\Exception $e) {
                      DB::rollback();
                      $notification = $e;
                      array(
                         'alert-type' => 'error',
                         'message' => 'Oooops!! an error occurred please try again later'
                      );
                   } 
                  
                   return redirect()->back()->with($notification);
              
              }
             
 }            