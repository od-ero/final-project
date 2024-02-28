<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Door;
use App\Models\Unit;
use App\Models\DoorIp;
use App\Models\MyPermission;
use DataTables;
class GlobalController extends Controller
{
public function index($encoded_permission_id){
    $permission_id = base64_decode($encoded_permission_id);
    //dd($unit_id);
    $my_permissions= MyPermission::where('id', $permission_id)->first();
    $unit_id= $my_permissions['unit_id'];
    $unit= unit::find($unit_id);
    $doors = Door::select('doors.id','doors.door_name')
                 ->where('unit_id', $unit_id)
                 ->get();
   // dd($unit);
    return view('ip_address',['unit' =>$unit,
                            'doors'  =>$doors,
                            'encoded_permission_id' =>$encoded_permission_id]);
}

public function index_data(Request $request, $unit_id){
   $unit_id= base64_decode($unit_id);

        $door_ips = DoorIp::LeftJoin('doors','doors.id','=','door_ips.door_id')
                     ->select('door_ips.*','doors.door_name')
                     ->where('doors.unit_id', $unit_id)
                     ->get();
                    // dd($door_ips);
        return DataTables::of( $door_ips)->make(true);
    }
public function create(Request $request){

    $ipDetails= $request->all();
    //dd($ipDetails);
  $add_ip =  DoorIp::create([
        'door_id'=> $ipDetails['door_id'],
        'ip_address' => $ipDetails['ip_address']

    ]);
    if($add_ip){
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Ip Address added successfully'
                  );
    }
    else{
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Oooops!! An error occured!! Please try again later'
                  );
    }
    return redirect()->back()->with($notification);
}
public function getIP($door_id){
    $ip_address = DoorIp::select('ip_address')
                        ->where('door_id', $door_id)
                        ->first();
         $ip_address =$ip_address->ip_address ;

         $baseurl = 'http://'.$ip_address ;
     dd($baseurl);
    return response()->json($ip_address);
}
public function show($door_ip_id, $encoded_permission_id){
    $ip_details = DoorIp::LeftJoin('doors','doors.id','=','door_ips.door_id')
    ->select('door_ips.*','doors.door_name')
    ->where('door_ips.id', $door_ip_id)
    ->first();
    
    return view('edit_ip',['ip_details'=>$ip_details,
                           'encoded_permission_id'=> $encoded_permission_id]);
}
public function update(Request $request){

    $ip_details = $request-> all();
    $update_ip= DoorIp::where('id', $ip_details['id'])
                        ->update([
                            'ip_address'=>  $ip_details['ip_address'],
                            ]);
    if($update_ip){
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Ip Address updated successfully'
                    );
    }
    else{
        $notification = array(
            'alert-type' => 'error',
            'message' => 'Oooops!! An error occured!! Please try again later'
                    );
    }
    return redirect()->route('global.index', ['id' => $ip_details['encoded_permission_id']])->with($notification);


}
}


