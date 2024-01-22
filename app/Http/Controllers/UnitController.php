<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


use Sentinel;
use DB;
use App\Models\Unit;
use App\Models\User;
use App\Models\MyUnit;
use App\Models\Door;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $my_units = MyUnit::leftjoin("units","my_units.unit_id","=","units.id")
        ->leftjoin("roles","my_units.role_id","=","roles.id")
        ->where('user_id',4)
        ->get();
       
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
       
       // dd($unit_details);
       // DB::beginTransaction();
        //try{
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
                'unit_id' =>   5,
               
            ]);
        }
    
  //  DB::commit();
        return response()->json([
            'status'=>'success',
            'message'=>'unit regestration succesful'
        ]);  

     //   }
    /* catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => 'error',
            'message' => 'unit regestration failed. Contact adminstrator'
        ]);
    } */
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
      // dd($unit_id);
       $unit= unit::find($unit_id);
         $my_unit = Door::leftjoin("door_statuses","door_statuses.door_id","=","doors.id")
         
          ->where('doors.unit_id',$unit_id)
         ->get();
         //dd( $my_unit);
         return view('myUnit' , ['myUnits' => $my_unit,
         'unit'=> $unit
            ]);

     }
 
    public function show(string $id)
    {
        $id=base64_decode($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)// open/close
    {
        $id=base64_decode($id);  //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
