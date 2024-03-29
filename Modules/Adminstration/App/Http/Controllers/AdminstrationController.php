<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Unit;
use App\Models\Door;
use App\Models\User;
class AdminstrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {// return view('adminstration::test');
        return view('adminstration::index');
    }

    /**
     * Show the form for creating a new resource.
     */
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

    public function chart(){
        $unitsCount = Unit::count();
        $usersCount = User::count();
        
        return view('adminstration::home.index',['total_units'=>$unitsCount, 'total_users'=>$unitsCount,]);
        //return view('adminstration::home.index');  
    }
    public function chartData(){
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
       
         // dd($units);
        // Return data as JSON response
        return response()->json($index_data);  
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
