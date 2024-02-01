<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use DB;
use App\Models\Permission;
use App\Models\DoorSchedule;
use App\Models\DoorSecheduleCounter;
use App\Models\DoorSchedulePermission;
use App\Models\Unit;
use App\Models\Door;
use App\Models\DoorScheduleDoor;
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
    public function store(Request $request, string $passed_unit_id)
    {
        //
        if($request->isMethod('get')){
            $unit_id= base64_decode($passed_unit_id);
             $doors= Door::where('unit_id', $unit_id)
                             ->get();
             $permission_groups=DoorSchedulePermission::where('user_id',Auth::id())
                                                        ->get('permission_name');
                                                      //  dd($permission_groups);
            return view('add_schedule' , [
                'doors'=>  $doors,
                'permission_groups'=>  $permission_groups,
                'unit_id' => $passed_unit_id
                   ]);

        }
        else
       { $schedules = $request->all();

      // dd($schedules);
        DB::beginTransaction();
        try{
        if($schedules['permission_group']==='create_new'){
       
        $create_permissions =DoorSchedulePermission::create([
            'permission_name' => Auth::id().'_P#name_'.$schedules['permission_group_name'],
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
        
        DoorScheduleDoor::create(
            [
                'door_schedule_id' => $schedule_create['id'],
                'door_id' => $door_id,
            ]);
    }
}
DB::commit();
$notification = array(
    'alert-type' => 'success',
    'message' => 'Door activation schedule set successfully');
    return redirect()->back()->with($notification);
       
        
}
       
     catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => 'error',
            'message' => 'Oooops!! an error occurred please try again later'
        ]);
    } 


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
