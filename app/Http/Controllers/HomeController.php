<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


use Sentinel;
use DB;
use App\Models\Unit;
use App\Models\MyUnit;
use App\Models\MyPermission;
use App\Models\Door;
use App\Models\DoorIp;
use Illuminate\Support\Facades\Auth;
use DataTables;

class HomeController extends Controller
{
    public function index() 
     {
        // $my_units = MyUnit::leftjoin("units","my_units.unit_id","=","units.id")
    //     ->leftjoin("roles","my_units.role_id","=","roles.id")
    //     ->where('user_id',Auth::id())
    //     ->get();
       // $my_units= DataTables::of($my_units)->make(true);
      
        return view('home.index');
        
    }
    public function index_data() 
    {
   
        $my_units = MyPermission::leftjoin("units","units.id","=","My_Permissions.unit_id")
                               ->where('My_Permissions.user_id',Auth::id())
                               ->where('My_Permissions.end_date','>',Carbon::now()->addHour())
                               ->select('My_Permissions.*','units.premises_name' ,'units.unit_name')
                                ->get();
    
                              
        return DataTables::of($my_units )
        ->make(true);
       
        
    }
    public function chart(){
        return view('charts');  
    }
    public function chartData(){
        $data = [
            ['country' => 'India Mumbai abajan apartments', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 0.5, 'cost_of_eggs' => 8],
            ['country' => 'India', 'cost_of_butter' => 0, 'cost_of_flour' => 3, 'cost_of_milk' => 5, 'cost_of_eggs' => 0.76],
             ['country' => 'RascaGardebs Apartments Ngong, g36 ', 'cost_of_butter' => 7, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 3],
             ['country' => 'ty', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 6, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 12, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India zero', 'cost_of_butter' => 35, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // ['country' => 'India', 'cost_of_butter' => 3, 'cost_of_flour' => 0.5, 'cost_of_milk' => 2, 'cost_of_eggs' => 2],
            // Add more data as needed
        ];

        // Return data as JSON response
        return response()->json($data);  
    }

   public function testServer(){
   $door_ips= DoorIp::all();
   foreach  ($door_ips as $door_ip)
   {
   //dd($door_ip['ip_address']);
       // $ip = '127.0.0.1';
       // $port = '22';
       // $url = $ip . ':' . $port;
       $url= $door_ip['ip_address'];
       //$url = '172.16.59.117';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($health) {
            if($door_ip['door_ip_status']==='Offline'){
            DoorIp::where('id',$door_ip['id'])
                    ->update([
                        'door_ip_status' => 'Online']);
            $json = json_encode(['health' => $health, 'status' => '1']);
           // return $json;
           }}
        else {
            if($door_ip['door_ip_status']==='Online'){

                DoorIp::where('id',$door_ip['id'])
                ->update([
                    'door_ip_status' => 'Offline']);
                $json = json_encode(['health' => $health, 'status' => '0']);
           // return $json;
        }
        }
    }
    return 'done';
    }
   
}