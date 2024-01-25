<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Sentinel;
use DB;
use App\Models\Permission;
use App\Models\Role;
use App\Models\MyPermission;
use App\Models\MyUnit;
use App\Models\PermissionGroup;
use App\Models\Unit;
use App\Models\Door;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::all();
        $doors=Door::all();
        $units=Unit::leftjoin("my_units","my_units.unit_id","=","units.id")
        ->where('my_units.user_id',Auth::id());
        return view('add_permission' , ['roles' => $roles,
        'doors' => $doors,
         'units'=>  $units
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        
      if($request->isMethod('get'))
       { $roles=Role::all();
        $doors=Door::all();
        $units=Unit::leftjoin("my_units","my_units.unit_id","=","units.id")
        ->where('my_units.user_id',Auth::id());
        return view('add_permission' , ['roles' => $roles,
        'doors' => $doors,
         'units'=>  $units,
         'unit_id' => $id
            ]);}
            else{
        $permissions = $request->all();
        DB::beginTransaction();
        try{
        $permission_group =PermissionGroup::create([
            'name' => $permissions['permission_group'],
            'creator_id' =>  Auth::id(),
        ]);
       // foreach ( $permissions as  $permission)  {
        $permission = $permissions;
        $permissions =Permission::create([
            'permission_group_id' => $permission_group['id'],
            'door_id' => $permission['door_id'],
           
            'give_permission' => $permission['give_permission'],
            'open' => $permission['open'],
            'close' => $permission['close'],
           ' schedule' => $permission['schedule'],
           'give_permission_fre' => $permission['give_permission_fre'],
           'open_fre' => $permission['open_fre'],
           'close_fre' => $permission['close_fre'],
           'schedule_fre' => $permission['schedule_fre']
        ]);

    
  //  $users=  $permissions['user_id'];
  //  foreach (  $users as $user)  {
    $my_permissions =MyPermission::create([
        'user_id' => $permission['user_id'],
        'permission_group_id' => $permission_group['id'],
        'permissioner_id' =>  3,
        'start_date' => $permission['start_date'],
        'end_date' => $permission['end_date'],
    ]);
        DB::commit();
        return response()->json([
            'status'=>'success',
            'message'=>'Permission Allocated Successfull'
        ]);  

        }
     catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => 'error',
            'message' => 'Oooops!! an error occurred please try again later'
        ]);
    } }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,)// add unit
    {
        $my_units_details = $request->all();
       // DB::beginTransaction();
       // try{
        $my_units =MyUnit::create([
            'user_id' => $my_units_details['user_id'],
            'unit_id' =>  $my_units_details['unit_id'],
            'role_id' =>   $my_units_details['role_id'],
            'start_date' =>  $my_units_details['start_date'],
            'end_date' =>  $my_units_details['end_date'],
            'permissioner_id' => 4,
        ]);
      //  DB::commit();
        return response()->json([
            'status'=>'success',
            'message'=>'Unit Allocated Successfullly'
        ]);  
   // }
   /* catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => 'error',
            'message' => 'Oooops!! an error occurred please try again later'
        ]);
    } */

    }

    /**
     * Update the specified resource in storage.
     */
    public function update( string $id)
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
