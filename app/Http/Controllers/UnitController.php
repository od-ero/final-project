<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


use Sentinel;
use DB;
use App\Models\Unit;
use App\Models\User;
use App\Models\MyUnit;
use App\Models\Door;
use App\Models\DoorStatus;
use DataTables;
class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $my_units = MyUnit::leftjoin("units","my_units.unit_id","=","units.id")
        ->leftjoin("roles","my_units.role_id","=","roles.id")
        ->where('user_id',Auth::id())
        ->get();
        $my_units= DataTables::of($my_units)->make(true);
        return view('home' , ['myUnits' => $my_units
            ]);
    }
    public function create(Request $request)
    {   if ($request->isMethod('get')) {
        $users= User::all();
        return view('add_my_unit' , [
        'users'=>  $users
           ]);
       
    } 
    else{
        $unit_details = $request->all();
       
       //dd($unit_details);
        DB::beginTransaction();
        try{
        $units =Unit::create([
            'unit_name' => $unit_details['unit_name'],
            'owner_id' =>   $unit_details['owner_id'],
            'premises_name' => $unit_details['premises_name'],
            'longitude'    =>  $unit_details['longitude'],
            'latitude'  =>$unit_details['latitude'],
            'doors' => $unit_details['doors']
        ]);
        
        for ($i = 0; $i < $unit_details['doors']; $i++) {
            $door_name_variable = 'door_name_' . $i;
            $door_names = $unit_details[$door_name_variable];
        //dd($unit_details);
            $units =Door::create([
                'door_name' => $door_names,
                'unit_id' => $units['id'],
               
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
        $notification = array(
            'message'    => 'Ooops!! an error occurred while processing your request.',
            'alert-type' => 'error',
);
    } 
    return redirect()->back()->with($notification);
}
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        //
    }

    /**
     * Display the specified resource.
     */

     public function selectedUnit(string  $unit_id)
     {
        $unit_id=base64_decode($unit_id);
       //dd($unit_id);
       $unit= unit::find($unit_id);
         
         //dd( $my_unit);
         return view('myUnit' , [
         'unit'=> $unit
            ]);

     }
 
     public function selectedUnitData(string  $unit_id)
     {
        $unit_id=base64_decode($unit_id);
       //dd($unit_id);
       
         $my_units = Door::leftjoin("door_statuses","door_statuses.door_id","=","doors.id")
         
          ->where('doors.unit_id',$unit_id)
         ->get();
         //dd( $my_unit);
         return DataTables::of($my_units)->make(true);
         
         
        

     }
 
    public function show(string $id)
    {
        $id=base64_decode($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $status )// open/close
    {
        $door_id=base64_decode($id); 
        $status= base64_decode($status);
       // DoorStatus::update(['status'=>'open'])
       // ->where('door_id', $door_id);
       // dd($id,  $status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
