<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use DB;
use App\Models\Unit;
use App\Models\Door;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function create(Request $request)
    {   
        $unit_details = $request->all();
        DB::beginTransaction();
        try{
        $units =Unit::create([
            'name' => $unit_details['name'],
            'owner_id' =>   $unit_details['owner_id'],
            'premises_name' => $unit_details['premises_name'],
            'longitude'    =>  $unit_details['longitude'],
            'latitude'  =>$unit_details['latitude'],
            'doors' => $unit_details['doors']
        ]);
        $door_names= $unit_details['door_name'];
        foreach ($door_names as  $door_name)  {
        $units =Door::create([
            'name' => $door_name,
            'unit_id' =>   $units['id'],
           
        ]);
    }
    DB::commit();
        return response()->json([
            'status'=>'success',
            'message'=>'unit regestration succesful'
        ]);  

        }
     catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => 'error',
            'message' => 'unit regestration failed. Contact adminstrator'
        ]);
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
