<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


use Sentinel;
use DB;
use App\Models\Unit;
use App\Models\MyUnit;
use App\Models\Door;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index() 
    {
   
        $my_units = MyUnit::leftjoin("units","my_units.unit_id","=","units.id")
        ->leftjoin("roles","my_units.role_id","=","roles.id")
        ->where('user_id',Auth::id())
        ->get();
       
        return view('home.index' , ['myUnits' => $my_units
            ]);
        
    }
}