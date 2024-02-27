<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Unit;
use App\Models\User;
use App\Models\MyPermissionCounter;
use App\Models\Door;
use App\Models\DoorStatus;
use App\Models\DoorStatusSetter;
use App\Models\MyPermission;
use App\Models\DoorIp;
use DataTables;
use Illuminate\Support\Facades\Http;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($door_id)
    {$ip_address= (new GlobalController)->getIp($door_id);
        $response = Http::get('http://'+$ip_address+'/?led_2_on');
        $response = Http::get('192.168.137.135/?led_2_on'); 
        dd($response);
       
        return response()->json($response);
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

     public function selectedUnit(string  $encoded_permission_id)
     { 
        $permission_id=base64_decode($encoded_permission_id);
        $my_permissions= MyPermission::where('id', $permission_id)->first();
       $unit_id= $my_permissions['unit_id'];
       $unit= unit::find($unit_id);
      
        //dd( $unit_id);
         return view('myUnit' , [
         'unit'=> $unit,
         'encoded_permission_id'=> $encoded_permission_id,
            ]);

     }
 
     public function selectedUnitData(string  $unit_id)
     {
       
        $unit_id= base64_decode($unit_id);
         $my_units = Door::leftjoin("door_statuses","door_statuses.door_id","=","doors.id")
                            ->where('doors.unit_id',$unit_id)
                            ->select('doors.*','door_statuses.status')
                            ->get();
        // dd($my_units);
         return DataTables::of($my_units)->make(true);
         
         
        

     }
 
    public function show(string $id)
    {
        $id=base64_decode($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $encoded_permission_id, string $status , string $userLatitude, string $userLongitude)// open/close
    { 
        $door_id= base64_decode($id); 
        $permission_id= base64_decode($encoded_permission_id);
        $status= base64_decode($status);
        $userLatitude= base64_decode($userLatitude);
        $userLongitude= base64_decode($userLongitude);
       //dd($door_id,$permission_id, $status, $userLatitude, $userLongitude);
       $units=Door::where('id', $door_id)
                    ->select('unit_id')->first();
    $unit_id =$units->unit_id;
    $ip_address = DoorIp::select('ip_address')
                        ->where('door_id', $door_id)
                        ->first();
     if($ip_address === null || empty($ip_address))
     {
        $notification = array(
            'alertType' => 'error',
            'message' => 'Oooops!! Ooops the door is not fullly configured kindly contact your host for assistance'
                  );
     }
     else{
         
         $ip_address =$ip_address->ip_address ;
          $unit = Unit::where('id', $unit_id)->first(); 
          $unitLat = $unit->latitude; // Room's latitude
          $unitLon = $unit->longitude; // Room's longitude
      
          // Calculate distance using Haversine formula
          $distanceKm = 6371 * acos(cos(deg2rad($userLatitude)) * cos(deg2rad($unitLat)) * cos(deg2rad($unitLon) - deg2rad($userLongitude)) + sin(deg2rad($userLatitude)) * sin(deg2rad($unitLat)));
      
          // Convert distance to meters
          $distanceMeters = $distanceKm * 1000;
      
          // $distanceMeters now contains the distance between the user's live location and the room's location in meters
         
      
     // dd($distanceMeters);
    //  if($distanceMeters >500){
    //     $notification = array(
    //         'alertType' => 'error',
    //         'message' => 'Oooops!! You are too far to perfrm this action kindly enable door access via button'
    //               );
    //  }
    //  else{
        $permissioner_permissions = MyPermission::leftjoin('permissions','my_permissions.permission_group_id','=','permissions.permission_group_id')
                                                -> where('my_permissions.id', $permission_id)
                                                 ->first();
       $permissioner_permission_end_date= Carbon::parse($permissioner_permissions['end_date']);
       $permissioner_permission_start_date= Carbon::parse($permissioner_permissions['start_date']);
       
       $permissioner_permissions_counters= MyPermissionCounter::where('my_permission_id', $permission_id)
                                                                ->where('door_id', $door_id)
                                                                
                                                                ->first();
      
      
     
       if($status==='Locked') {
        $permissioner_permissions_count= $permissioner_permissions_counters['open'];
       // dd($permissioner_permissions_count);
       if( $permissioner_permissions['open']==='no'){
        $notification = array(
            'alertType' => 'error',
            'message' => 'Ooops!!!, You are not allowed to open this door'
        );   
    }
   else if($permissioner_permissions_count >= $permissioner_permissions['open_fre']){
        $notification = array(
        'alertType' => 'error',
        'message' => 'Ooops!!!, You have exhausted your open permissions on this door' 
        );       
        }
    else if($permissioner_permission_start_date->gt(Carbon::now())){
        $notification = array(
             'alertType' => 'error',
             'message' => 'Ooops!!!, You are not allowed to open this door at this time'
         );     
    }

    else if($permissioner_permission_end_date->lt(Carbon::now())){
        $notification = array(
            'alertType' => 'error',
            'message' => 'Ooops!!!, Your priviledge to open this door expired'
        );     
    }
    else{
        DB::beginTransaction();
        try{
         DoorStatus::where('door_id', $door_id)
                    ->update(['status'=>'Unlocked',
                    'status_setter'=>Auth::id(),
                ]);
        MyPermissionCounter::where('my_permission_id' ,$permission_id)
                            ->where('door_id', $door_id)
                            ->update([
                                'open' => $permissioner_permissions_count + 1,
                               
                            ]);
        
                           
            DoorStatusSetter::create([
                          'door_id'=> $door_id,
                          'status' => 'Unlocked',
                          'user_id'=> Auth::id()
            ]) ;
           
            $url = 'http://'.$ip_address.'/?led_2_on';
            
        $response = Http::get($url);
       // dd($response);
            DB::commit();
           // dd($response);
            $notification = array(
                'alertType' => 'success',
                'message' => 'Door unlocked successfully'
            );
        }
        catch (\Exception $e) {
           DB::rollback();
          $notification =
        array(
          'alertType' => 'error',
          'message' => 'Oooops!! an error occurred please contact your adminstrator for assistance'  );
} 
    }
}
if($status==='Unlocked') {
    $permissioner_permissions_count= $permissioner_permissions_counters['close'];
   if( $permissioner_permissions['close']==='no'){
    $notification = array(
        'alertType' => 'error',
        'message' => 'Ooops!!!, You are not allowed to lock this door'
    );   
}
else if($permissioner_permissions_count >= $permissioner_permissions['close_fre']){
    $notification = array(
    'alertType' => 'error',
    'message' => 'Ooops!!!, You have exhausted your lock permissions on this door' 
    );       
    }
else if($permissioner_permission_start_date->gt(Carbon::now())){
    $notification = array(
         'alertType' => 'error',
         'message' => 'Ooops!!!, You are not allowed to lock this door at this time'
     );     
}

else if($permissioner_permission_end_date->lt(Carbon::now())){
    $notification = array(
        'alertType' => 'error',
        'message' => 'Ooops!!!, Your priviledge to lock this door expired'
    );     
}
else{
    DB::beginTransaction();
    try{
     DoorStatus::where('door_id', $door_id)
                ->update(['status'=>'Locked',
                'status_setter'=>Auth::id(),
            ]);
    MyPermissionCounter::where('my_permission_id' ,$permission_id)
                        ->where('door_id', $door_id)
                        ->update([
                            'close' => $permissioner_permissions_count + 1,
                        ]);
    
                       
        DoorStatusSetter::create([
                      'door_id'=> $door_id,
                      'status' => 'Lock',
                      'user_id'=> Auth::id()
         ]) ;
        // $ip_address= (new GlobalController)->getIp($door_id);
        // //$baseurl=json_decode($baseurl);
        // $ip_address = trim($ip_address, '"'); // Remove surrounding quotes if present
        $url = 'http://'.$ip_address.'/?led_2_off';
        
        $response = Http::get($url);
        
        //dd($response);
        DB::commit();
        $notification = array(
            'alertType' => 'success',
            'message' => 'Door locked successfully'
        );
    }
    catch (\Exception $e) {
       DB::rollback();
      $notification = array(
      'alertType' => 'error',
      'message' => 'Oooops!! an error occurred please contact your adminstrator for assistance'
            );
} 
}
}
//}
}
return response()->json($notification); 
    
}
   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
