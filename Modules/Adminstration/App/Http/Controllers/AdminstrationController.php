<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Unit;
use App\Models\Door;
use App\Models\DoorIp;
use App\Models\User;
use Carbon\CarbonInterval;

class AdminstrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitsCount = Unit::count();
        $usersCount = User::count();
        $doorOnlineCount = DoorIp::where('door_ip_status','Online')
                                ->count();
        $doorOfflineCount = DoorIp::where('door_ip_status','Offline')
                                    ->count();
         $onlineTimeSeconds =  $doorOnlineCount * 0.5;
         $offlineTimeSeconds = $doorOfflineCount * 5.1;
         $totalTimeSeconds =  $onlineTimeSeconds + $offlineTimeSeconds;
         $interval = CarbonInterval::seconds($totalTimeSeconds)->cascade();
        if ($interval->lessThan('1m')) {
            $totalTime= $interval->forHumans(['parts' => 1]);
        } elseif ($interval->lessThan('1h')) {
            $totalTime= $interval->forHumans(['parts' => 2]);
        } else {
            $totalTime= $interval->forHumans(['parts' => 3]);
        }
        return view('adminstration::home.index',['total_units'=>$unitsCount, 'total_users'=>$usersCount,'totalTime'=>$totalTime]);
    }
    public function indexData(){
        $units= Unit::leftJoin('doors','doors.unit_id','=','units.id')
                        ->leftJoin('door_ips','door_ips.door_id','=','doors.id')
                        ->select('units.id as unit_id','units.unit_name','units.premises_name','doors.door_name','door_ips.door_ip_status')
                        ->orderBy('units.premises_name', 'asc')
                        ->get();
        $units= Unit::all();
        $index_data=[];
        foreach($units as $unit){
        $unit_inactive = 0;
        $unit_online = 0;
        $unit_offline = 0;
        $doors= Door::leftJoin('door_ips','door_ips.door_id','=','doors.id')
                ->select('*')
                ->where('doors.unit_id',$unit['id'])
                ->get();
        foreach($doors as $door){
            if($door['door_ip_status']==='Online'){
            $unit_online ++ ;   
            }else if($door['door_ip_status']==='Offline'){
            $unit_offline ++ ;  
            }else{
            $unit_inactive ++ ;   
            }
        }
        $data=['unit_id'=> $unit['id'],
            'premises_name'=> $unit['premises_name'],
            'unit_name'=>$unit['unit_name'],
            'count_online'=>  $unit_online,
            'count_offline'=>  $unit_offline,
            'count_inactive'=> $unit_inactive
        ];
        array_push($index_data, $data);
        }

        return response()->json($index_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function devicesHealth(){
        $door_ips= DoorIp::select('*')
        ->whereNot('door_ip_status', 'Inactive')
         ->get();
         try{
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
                // $json = json_encode(['health' => $health, 'status' => '1']);
                // return $json;
                }}
                else {
                if($door_ip['door_ip_status']==='Online'){

                    DoorIp::where('id',$door_ip['id'])
                    ->update([
                        'door_ip_status' => 'Offline']);
                }
                }
                 }
                 $notification = array(
                    'alert-type' => 'success',
                    'message' => 'Devices health statuses scanned and Updated successfully'
                          );
                }
                catch (\Exception $e) {
                  $notification = array(
                  'alert-type' => 'error',
                  'message' => 'Oooops!! an error occurred please try again later'
                        );
     } 
        
        return redirect()->back()->with($notification);
}
    public function create()
    {
        return view('adminstration::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }
   
    
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('adminstration::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('adminstration::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
