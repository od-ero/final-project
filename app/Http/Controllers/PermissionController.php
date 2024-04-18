<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DataTables;
use DB;
use App\Models\Permission;
use App\Models\MyPermission;
use App\Models\MyUnit;
use App\Models\PermissionGroup;
use App\Models\Unit;
use App\Models\Door;
use App\Models\MyPermissionCounter;
use App\Models\MyPermissionDoor;
use Carbon\Carbon;

use function Laravel\Prompts\select;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $encoded_permission_id)
    { 
       
        $passed_permission_id=base64_decode($encoded_permission_id);
        $my_permissions= MyPermission::where('id', $passed_permission_id)->first();
        $passed_unit_id= $my_permissions['unit_id'];
       if($request->isMethod('get')){
      // $roles=Role::all();
       $doors=Door::where('unit_id', $passed_unit_id)
                    ->get();
       $permission_groups=PermissionGroup::where('creator_id', Auth::id())
                                             ->get();
            $unit= unit::find($passed_unit_id);
       return view('add_permission' , [
                    'doors' => $doors,
                     'unit'=> $unit,
                        'permission_groups' => $permission_groups,
                        'encoded_permission_id' => $encoded_permission_id
                        ]);}
else{
    $permissioner_permissions = MyPermission::leftjoin('permissions','my_permissions.permission_group_id','=','permissions.permission_group_id')
                                             -> where('my_permissions.id', $passed_permission_id)
                                            ->first();
                                                     
    $permissions = $request->all();

    
  
   $start_date= Carbon::parse($permissions['start_date']);
   $end_date= Carbon::parse($permissions['end_date']);
   $permissioner_permission_end_date= Carbon::parse($permissioner_permissions['end_date']);
   $permissioner_permission_start_date= Carbon::parse($permissioner_permissions['start_date']);
   
   if($permissions['permission_group']==='create_new'){
    if($permissions['give_permission']=='yes' && $permissions['give_permission_fre']<1){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, Kindly fill in give permission frequency'
        );  
    }else if($permissions['open_fre']<1 && $permissions['open']==='yes'){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, Kindly fill in unlock frequency'
        );  
    }else if($permissions['close']=='yes' && $permissions['close_fre']<1){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, Kindly fill in lock frequency'
        );  
    }
    else if($permissions['schedule']=='yes' && $permissions['schedule_fre']<1){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, Kindly fill in schedule frequency'
        );  
    }
}
    if( $permissioner_permissions['give_permission']==='no'){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, You are not allowed to give permissions'
        );   
    }
    else if($permissioner_permission_start_date->gt($start_date)){
        $notification = array(
             'alert-type' => 'error',
             'message' => 'Ooops!!!, Start date must be greater than your assigned start date'
         );     
    }

    else if($permissioner_permission_end_date->lt($end_date)){
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Ooops!!!, End date must be less than your assigned end date '
        );     
    }
   else{
   
  DB::beginTransaction();
  try{
        if($permissions['permission_group']==='create_new'){

                $permission_group =PermissionGroup::create([
                    'name' => $permissions['permission_group_name'],
                    'creator_id' =>  Auth::id(),
                ]);
            // foreach ( $permissions as  $permission)  {
               
                $create_permissions =Permission::create([
                    'permission_group_id' => $permission_group['id'],
                    'give_permission' =>  $permissions['give_permission'],
                    'open' =>  $permissions['open'],
                    'close' =>  $permissions['close'],
                    'schedule' =>  $permissions['schedule'],
                    'give_permission_fre' => $permissions['give_permission'] == 'no' ? 0 : $permissions['give_permission_fre'],
                    'open_fre' => $permissions['open'] == 'no' ? 0 : $permissions['open_fre'],
                    'close_fre' => $permissions['close'] == 'no' ? 0 : $permissions['close_fre'],
                    'schedule_fre' => $permissions['schedule'] == 'no' ? 0 : $permissions['schedule_fre']
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
                 'unit_id'       => $passed_unit_id,
                'start_date' => $start_date ,
                'end_date' =>  $end_date,
                //'end_date' =>  Carbon::parse($permissions['end_date'])->toW3cString(),
            ]);

           

            foreach ($permissions as $door_name_ => $door_id) {
                if (strpos($door_name_, 'door_id_') !== false) {
                    $permissioner_permissions_counters= MyPermissionCounter::where('my_permission_id', $passed_permission_id)
                    ->where('door_id', $door_id)
                                        ->first();
                    $door_name = Door::where('id', $door_id)
                    ->select('door_name')
                    ->first();
                   
                    //dd( $permissioner_permissions_counters);
                    $permissioner_permissions_count= $permissioner_permissions_counters['give_permission'];

                    if($permissioner_permissions_count >= $permissioner_permissions['give_permission_fre']){
                    $notification = array(
                    'alert-type' => 'error',
                    'message' => 'Ooops!!!, You have exhausted your permissions on door' .$door_name 
                    );       
                    }else{
                        MyPermissionCounter::create([
                            'my_permission_id' => $my_permissions['id'],
                            'door_id'  => $door_id,
                            'give_permission' => 0,
                            'open' => 0,
                            'close' => 0,
                            'schedule' =>0,
                            ]);
                            MyPermissionDoor::create(
                                [
                                    'my_permission_id' => $my_permissions['id'],
                                    'door_id' => $door_id,
                                
                                ]);
                                MyPermissionCounter::where('my_permission_id' ,$passed_permission_id)
                                                    ->where('door_id', $door_id)
                                                    ->update([
                                                        'give_permission' => $permissioner_permissions_count + 1,
                                                    ]);
                    }


                                           
                }
            }      
                                                                          ;
            
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
}
 
 return redirect()->back()->with($notification);
}
}   
    
public function create(Request $request){
    
       
}
    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update( string $encoded_permission_id)
    {//
    }

    public function myPermissions($encoded_permission_id)
    {
        return view('permissions.myPermissions',['encoded_permission_id'=> $encoded_permission_id]);
    }
    public function myPermissionsData($encoded_permission_id)
    {
        $permission_id=base64_decode($encoded_permission_id);
        $current_permissions=MyPermission::select('*')
                            ->where('id', $permission_id)
                            ->first();
        //dd($permission_id);
        if($current_permissions){
            $unit_id= $current_permissions['unit_id'];
            $house_owner= myPermission::where('unit_id',$unit_id)
                                        ->where('permissioner_id',1001)
                                        ->value('user_id');
        //$current_permissions=MyPermission::where('id',) 
        if($current_permissions['user_id']== $house_owner || $current_permissions['permissioner_id']==$house_owner){
            $my_permissions= MyPermission::leftJoin('permission_groups','my_permissions.permission_group_id','=','permission_groups.id')
                                            ->leftJoin('users','users.id','=','my_permissions.user_id')
                                            ->leftJoin('users as permissioner','permissioner.id','=','my_permissions.permissioner_id')
                                            ->select('my_permissions.*','permission_groups.name','users.fname','users.lname','permissioner.fname as pfname','permissioner.lname as plname')
                                           ->where('my_permissions.unit_id',$unit_id)
                                           ->whereNot('my_permissions.user_id',$house_owner)
                                            ->where('my_permissions.end_date','>',Carbon::now()->subDay())
                                            ->get();
        } else {                   
            $my_permissions= MyPermission::leftJoin('permission_groups','my_permissions.permission_group_id','=','permission_groups.id')
                                    ->leftJoin('users','users.id','=','my_permissions.user_id')
                                    ->leftJoin('users as permissioner','permissioner.id','=','my_permissions.permissioner_id')
                                    ->select('my_permissions.*','permission_groups.name','users.fname','users.lname','permissioner.fname as pfname','permissioner.lname as plname')
                                    ->where('my_permissions.permissioner_id',Auth::id())
                                    ->where('my_permissions.unit_id',$unit_id)
                                    ->where('my_permissions.end_date','>',Carbon::now()->subDay())
                                    ->get();
       } }else{
            $my_permissions=[];
        }
        
                                    
        return DataTables::of($my_permissions)->make(true);                           
    }

    public function editMyPermissions(Request $request, $encoded_permission_id, $encoded_selected_permission_id){
        $selected_permission_id=base64_decode($encoded_selected_permission_id);
        if($request->isMethod('get')){

            $selected_permission= MyPermission::leftJoin('permission_groups','permission_groups.id','=','my_permissions.permission_group_id')
                                             ->leftJoin('users','users.id','=','my_permissions.user_id')
                                            ->where('my_permissions.id',$selected_permission_id)
                                            ->select('my_permissions.*','permission_groups.name as permission_group_name','users.fname','users.lname','users.phone','users.id as user_id')
                                            ->first();
                            
            $selectedDoors = MyPermissionDoor::where('my_permission_id', $selected_permission_id)
                                            ->pluck('door_id') 
                                            ->toArray(); 
            $unit =Unit::where('id',$selected_permission['unit_id'])
                        ->select('*')
                        ->first();
            $doors=Door::where('unit_id', $selected_permission['unit_id'])
                        ->select('*')
                        ->get();
             $permission_groups= PermissionGroup::where('creator_id',Auth::id())
                                                ->select('*')
                                                ->get();
            return view('permissions.editMyPermissions',['selected_permission'=>$selected_permission, 
                                                        'selectedDoors'=>$selectedDoors,
                                                        'doors'=>$doors,
                                                        'unit' =>$unit,
                                                        'permission_groups'=>$permission_groups,
                                                        'encoded_permission_id'=>$encoded_permission_id]);
        }else{
            $permissions=$request->all();
           // dd($permissions);
           
           $permissioner_permissions = MyPermission::leftjoin('permissions','my_permissions.permission_group_id','=','permissions.permission_group_id')
           -> where('my_permissions.id', $selected_permission_id)
          ->first();
            $start_date= Carbon::parse($permissions['start_date']);
            $end_date= Carbon::parse($permissions['end_date']);
            $permissioner_permission_end_date= Carbon::parse($permissioner_permissions['end_date']);
            $permissioner_permission_start_date= Carbon::parse($permissioner_permissions['start_date']);
            if( $permissioner_permissions['give_permission']==='no'){
                $notification = array(
                    'alert-type' => 'error',
                    'message' => 'Ooops!!!, You are not allowed to give permissions'
                );   
            }else if($permissioner_permission_start_date->gt($start_date)){
                $notification = array(
                     'alert-type' => 'error',
                     'message' => 'Ooops!!!, Start date must be greater than your assigned start date'
                 );     
            }
        
            else if($permissioner_permission_end_date->lt($end_date)){
                $notification = array(
                    'alert-type' => 'error',
                    'message' => 'Ooops!!!, End date must be less than your assigned end date '
                );     
            }
           else{
            DB::beginTransaction();
             try{
                    $my_permissions =MyPermission::where('id',$selected_permission_id)
                                                ->update([
                                                        'user_id' => $permissions['user_id'],
                                                        'permission_group_id' => $permissions['permission_group_id'],
                                                        'permissioner_id' =>  Auth::id(),
                                                        'start_date' => $permissions['start_date'] ,
                                                        'end_date' =>  $permissions['end_date'],
                                                    ]);
                    MyPermissionDoor::where('my_permission_id',$selected_permission_id)
                                    ->delete();
                                                    
                    foreach ($permissions as $door_name_ => $door_id) {
                        if (strpos($door_name_, 'door_id_') !== false) {
                        
                                    MyPermissionDoor::create(
                                        [
                                            'my_permission_id' =>$selected_permission_id,
                                            'door_id' => $door_id,
                                        
                                        ]);
                            }                    
                        }

                        DB::commit();
                                    $notification = array(
                                        'alert-type' => 'success',
                                        'message' => 'Permission updated successfully'
                                    );
                        }
                        catch (\Exception $e) {
                            DB::rollback();
                                $notification = 
                                array(
                                'alert-type' => 'error',
                                'message' => 'Oooops!! an error occurred please contact your adminstrator for assistance'
                                );
                    } }
                    return redirect()->route('permissions.myPermissions', ['id' => $encoded_permission_id])->with($notification);

                    
            }
        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
      $permission_id= $request->all();
      $permission_id=$permission_id['permission_id'];
     // dd($permission_id);
      DB::beginTransaction();
      try{
         MyPermissionDoor::where('my_permission_id',$permission_id)
                     ->delete();
                    // dd($x);
        MyPermission::where('id','=',$permission_id)
                    ->delete();

            DB::commit();

         $notification =array(
                    'alert-type' => 'success',
                    'message' => 'Permission revoked successfully'
                            );            
    } 
    catch (\Exception $e) {
    DB::rollback();
    $notification = 
    array(
    'alert-type' => 'error',
    'message' => 'Oooops!! an error occurred please contact your adminstrator for assistance'
            );
} 
return redirect()->back()->with($notification);


}

public function PermissionGroupdestroy(Request $request)
    {
      $permission_group_id= $request->all();
      $permission_group_id=$permission_group_id['permission_id'];
      DB::beginTransaction();
      try{
         Permission::where('permission_group_id',$permission_group_id)
                     ->delete();
                    // dd($x);
       PermissionGroup::where('id',$permission_group_id)
                    ->delete();

            DB::commit();

         $notification =array(
                    'alert-type' => 'success',
                    'message' => 'Permission group revoked successfully'
                            );            
    } 
    catch (\Exception $e) {
    DB::rollback();
    $notification = 
    array(
    'alert-type' => 'error',
    'message' => 'Oooops!! an error occurred please contact your adminstrator for assistance'
            );
} 
return redirect()->back()->with($notification);


}
public function permissionGroups($encoded_permission_id){
    return view('permissions.permissionGroups',['encoded_permission_id'=>$encoded_permission_id]);
}   
public function permissionGroupsData(){
    $myPermissionGroups= PermissionGroup::leftjoin('permissions','permissions.permission_group_id','=','permission_groups.id')
                                           -> where('permission_groups.creator_id',Auth::id())
                                           ->orderBy('permission_groups.name','asc')
                                           -> get();
    return DataTables::of($myPermissionGroups)->make(true); 
}   
public function addPermissionGroup(Request $request ,$encoded_permission_id)
{
    //$permission_group_id=base64_decode($encoded_permission_id);
    if($request->isMethod('get')){ 
        return view('permissions.addPermissionGroup',['encoded_permission_id'=>$encoded_permission_id]);
    }
    else{
        $permissions= $request->all();
        if($permissions['give_permission']=='yes' && $permissions['give_permission_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in give permission frequency'
            );  
        }else if($permissions['open']=='yes' && $permissions['open_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in unlock frequency'
            );  
        }else if($permissions['close']=='yes' && $permissions['close_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in lock frequency'
            );  
        }
        else if($permissions['schedule']=='yes' && $permissions['schedule_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in schedule frequency'
            );  
        }else{
        DB::beginTransaction();
        try{
                      $permission_group =PermissionGroup::create([
                          'name' => $permissions['permission_group_name'],
                          'creator_id' =>  Auth::id(),
                      ]);
                  // foreach ( $permissions as  $permission)  {
                     
                    Permission::create([
                        'permission_group_id' => $permission_group['id'],
                        'give_permission' => $permissions['give_permission'],
                        'open' => $permissions['open'],
                        'close' => $permissions['close'],
                        'schedule' => $permissions['schedule'],
                        'give_permission_fre' => $permissions['give_permission'] == 'no' ? 0 : $permissions['give_permission_fre'],
                        'open_fre' => $permissions['open'] == 'no' ? 0 : $permissions['open_fre'],
                        'close_fre' => $permissions['close'] == 'no' ? 0 : $permissions['close_fre'],
                        'schedule_fre' => $permissions['schedule'] == 'no' ? 0 : $permissions['schedule_fre']
                    ]);
                    
                     
            DB::commit();

            $notification =array(
                        'alert-type' => 'success',
                        'message' => 'Permission group created successfully'
                                );            
        } 
        catch (\Exception $e) {
        DB::rollback();
        $notification = 
        array(
        'alert-type' => 'error',
        'message' => 'Oooops!! an error occurred please contact your adminstrator for assistance'
                );
    } }
    return redirect()->back()->with($notification);
        }
    }


public function editPermissionGroup(Request $request ,$encoded_permission_id, $encoded_permission_group_id){
   $permission_group_id=base64_decode($encoded_permission_group_id);
    if($request->isMethod('get')){

        $permissionGroup= PermissionGroup::leftjoin('permissions','permissions.permission_group_id','=','permission_groups.id')
                                    -> where('permission_groups.id',$permission_group_id)
                                    ->select('permissions.*','permission_groups.name',)
                                    ->first();
        return view('permissions.editPermissionGroup',['encoded_permission_id'=>$encoded_permission_id,
                                                     'permissionGroup'=>$permissionGroup,
                                                    'encoded_permission_group_id'=>$encoded_permission_group_id
                        ]);
    }else{
        $permissions=$request->all();
        if($permissions['give_permission']=='yes' && $permissions['give_permission_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in give permission frequency'
            );  
        }else if($permissions['open']=='yes' && $permissions['open_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in unlock frequency'
            );  
        }else if($permissions['close']=='yes' && $permissions['close_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in lock frequency'
            );  
        }
        else if($permissions['schedule']=='yes' && $permissions['schedule_fre']<1){
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Ooops!!!, Kindly fill in schedule frequency'
            );  
        }else{
        DB::beginTransaction();
      try{
        PermissionGroup::where('id',$permission_group_id)
                        ->update([
                                'name' => $permissions['permission_group_name'],
                                'creator_id' =>  Auth::id(),
                            ]);
    
       
        Permission::where('permission_group_id', $permission_group_id)
                    ->update([
                        'permission_group_id' => $permission_group_id,
                        'give_permission' => $permissions['give_permission'],
                        'open' => $permissions['open'],
                        'close' => $permissions['close'],
                        'schedule' => $permissions['schedule'],
                        'give_permission_fre' => $permissions['give_permission'] == 'no' ? 0 : $permissions['give_permission_fre'],
                        'open_fre' => $permissions['open'] == 'no' ? 0 : $permissions['open_fre'],
                        'close_fre' => $permissions['close'] == 'no' ? 0 : $permissions['close_fre'],
                        'schedule_fre' => $permissions['schedule'] == 'no' ? 0 : $permissions['schedule_fre']
                    ]);
                    DB::commit();

                    $notification =array(
                                'alert-type' => 'success',
                                'message' => 'Permission group updated successfully'
                                        );            
                } 
                catch (\Exception $e) {
                DB::rollback();
                $notification = 
                array(
                'alert-type' => 'error',
                'message' => 'Oooops!! an error occurred please contact your adminstrator for assistance'
                        );
            } }
            return redirect()->route('permissions.permissionGroups', ['id' => $encoded_permission_id])->with($notification);                              
    }
}

    public function viewPermission($encoded_permission_id, $encoded_selected_permission_id){
        $permission_id = base64_decode($encoded_selected_permission_id);
         $permission= MyPermission::LeftJoin('permission_groups','permission_groups.id','=','my_permissions.permission_group_id')
                                    -> leftjoin('permissions','permissions.permission_group_id','=','permission_groups.id')
                                    ->where('my_permissions.id',$permission_id)
                                    ->select('permissions.*')
                                    ->first();
        $permissioncounters= MyPermissionCounter::leftJoin('doors','doors.id','=','my_permission_counters.door_id')
                                                -> where('my_permission_counters.my_permission_id',$permission_id)
                                                ->select('my_permission_counters.*','doors.door_name')
                                                ->get();
        return view('permissions.viewPermission',['permission'=>$permission,
                                                    'myPermissionCounters'=>$permissioncounters,
                                                    'encoded_permission_id'=>$encoded_permission_id]);
    }
}
