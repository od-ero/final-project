<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Unit;
use App\Models\Door;
use App\Models\User;
use DB;
use DataTables;
use Illuminate\Support\Facades\Http;
class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $rooms = Unit::leftjoin('users','units.owner_id','users.id')
                        ->select('units.*', 'users.fname', 'users.lname')
                        ->orderBy('units.premises_name', 'asc')
                        ->get();

    $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=-0.3974645,36.9648429&sensor=true&key=".env('GOOGLE_MAPS_API_KEY');
    $dd=file_get_contents($url);
    $dd=json_decode($dd);
dd($dd->results);
    //Http::get($url);
        return view('adminstration::rooms.index',['rooms'=> $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   if($request->isMethod('get')) {
        
             $users= User::all();
             return view('adminstration::rooms.add_my_unit' , [
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
