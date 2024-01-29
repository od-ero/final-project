<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use DB;
use App\Models\Permission;
use App\Models\DoorSechedule;
use App\Models\DoorSecheduleCounter;
use App\Models\DoorSechedulePermission;
use App\Models\Unit;
use App\Models\Door;
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
             $permission_groups=DoorSechedulePermission::where('user_id',Auth::id())
                                                        ->get();
            return view('add_schedule' , [
                'doors'=>  $doors,
                'permission_groups'=>  $permission_groups,
                'unit_id' => $passed_unit_id
                   ]);

        }
        else
       { $schedules = $request->all();
       // DB::beginTransaction();
       // try{
        $door_sechedule_permission =DoorSechedulePermission::create([
            'name' => $schedules['schedule_group'],
            'user_id' => Auth::id(),
        ]);
       // foreach ( $permissions as  $permission)  {
       
        $permissions =DoorSechedule::create([
            'door_sechedule_permission_id' =>  $door_sechedule_permission['id'],
            'door_id' =>  $schedules['door_id'],
            'open_in' =>  $schedules['open_in'],
            'close_in' =>  $schedules['close_in'],
            'open_out' =>  $schedules['open_out'],
            'close_out' =>  $schedules['close_out'],
           'start_date' =>  $schedules['start_date'],
           'end_date' =>  $schedules['end_date'],
           'user_id' =>  Auth::id(),
           'open_in_fre' =>  $schedules['open_in_fre'],
           'close_in_fre' =>  $schedules['close_in_fre'],
           'open_out_fre' =>  $schedules['open_out_fre'],
           'close_out_fre' =>  $schedules['close_out_fre'],
          
        ]);

       // DB::commit();
        return response()->json([
            'status'=>'success',
            'message'=>'Schedule set Successfull'
        ]);  
}
      /*  }
     catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => 'error',
            'message' => 'Oooops!! an error occurred please try again later'
        ]);
    } 
*/

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
