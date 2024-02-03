<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use DB;
use App\Models\MyPermissionCounter;
use App\Models\DoorSchedule;
use App\Models\MyPermission;
use App\Models\DoorSecheduleCounter;
use App\Models\DoorSchedulePermission;
use App\Models\Unit;
use App\Models\Door;
use App\Models\DoorScheduleDoor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        DoorScheduleDoor::create(
            [
                'door_schedule_id' => $schedule_create['id'],
                'door_id' => $door_id,
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
