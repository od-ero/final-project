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
use App\Models\MyPermissionDoor;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;



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
    public function store(Request $request, $unit_id)
    { 
        $unit_id= base64_decode($unit_id);
       if($request->isMethod('get')){
      // $roles=Role::all();
       $doors=Door::where('unit_id', $unit_id)
                    ->get();
       $permission_groups=PermissionGroup::where('creator_id', Auth::id())
                                             ->get();
       $units=Unit::leftjoin("my_units","my_units.unit_id","=","units.id")
                    ->where('my_units.user_id',Auth::id())
                    ->where('my_units.end_date','>', Carbon::now())
                    ->get();
       return view('add_permission' , [
                    'doors' => $doors,
                        'units'=>  $units,
                        'permission_groups' => $permission_groups,
                        'unit_id' => $unit_id
                        ]);}
else{
    $permissions = $request->all();
   
     DB::beginTransaction();
     try{
        if($permissions['permission_group']==='create_new'){

                $permission_group =PermissionGroup::create([
                    'name' => $permissions['permission_group'],
                    'creator_id' =>  Auth::id(),
                ]);
            // foreach ( $permissions as  $permission)  {
                $permission = $permissions;
                $create_permissions =Permission::create([
                    'permission_group_id' => $permission_group['id'],
                    'give_permission' =>  $permissions['give_permission'],
                    'open' =>  $permissions['open'],
                    'close' =>  $permissions['close'],
                ' schedule' =>  $permissions['schedule'],
                'give_permission_fre' =>  $permissions['give_permission_fre'],
                'open_fre' =>  $permissions['open_fre'],
                'close_fre' =>  $permissions['close_fre'],
                'schedule_fre' =>  $permissions['schedule_fre']
                ]);
                $use_permission_group_id=  $permission_group['id'];
            }
                else{
                    $use_permission_group_id=  $permissions['permission_group_id'] ;
                }
            $my_permissions =MyPermission::create([
                'user_id' => $permissions['user_id'],
               // 'door_id' => $permission['door_id'],
                'permission_group_id' => $use_permission_group_id,
                'permissioner_id' =>  Auth::id(),

                'start_date' => Carbon::parse($permissions['start_date'])->toW3cString() ,
                'end_date' =>  $permissions['end_date'],
                //'end_date' =>  Carbon::parse($permissions['end_date'])->toW3cString(),
            ]);

           

            foreach ($permissions as $door_name_ => $door_id) {
                if (strpos($door_name_, 'door_id_') !== false) {
                    
                    MyPermissionDoor::create(
                        [
                            'my_permission_id' => $my_permissions['id'],
                            'door_id' => $door_id,
                        ]);
                }
            }
            
            
                DB::commit();
                $notification = array(
                    'alert-type' => 'success',
                    'message' => 'Permission allocated successfully'
                );

            }
            catch (\Exception $e) {
                DB::rollback();
                $notification = array(
                'alert-type' => 'error',
                'message' => 'Oooops!! an error occurred please try again later'
                     );
 } 
 return redirect()->back()->with($notification);
}
}   
    
public function create(Request $request){
    
       
}
    /**
     * Display the specified resource.
     */
    public function show(Request $request,)// add unit
    {
        $my_units_details = $request->all();
        DB::beginTransaction();
        try{
        $my_units =MyUnit::create([
            'user_id' => $my_units_details['user_id'],
            'unit_id' =>  $my_units_details['unit_id'],
            'role_id' =>   $my_units_details['role_id'],
            'start_date' =>  $my_units_details['start_date'],
            'end_date' =>  $my_units_details['end_date'],
            'permissioner_id' => 4,
        ]);
        DB::commit();
      $notification = array(
        'message'    => 'Priviledges assigned successfully',
        'alert-type' => 'success',
);
} 

        
   // }
   catch (\Exception $e) {
        DB::rollback();
           $notification = array(
            'alert-type' => 'error',
            'message' => 'Oooops!! an error occurred please try again later'
        );
    } 
    return redirect()->back()->with($notification);
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
