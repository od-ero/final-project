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
   
}