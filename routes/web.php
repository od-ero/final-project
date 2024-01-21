<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('register');
});


Route::match(['GET','POST'],'/login',[UsersController::class,'login']);
Route::match(['GET','POST'],'/register',[UsersController::class,'register']);
Route::get('/logout',[UsersController::class,'logout']);
Route::post('/units',[UnitController::class,'create']);
Route::get('/home/myunits',[UnitController::class,'index']);
Route::match(['GET','update','POST'],'/home/myunits/action/{id}',[UnitController::class,'update']);
Route::get('/selected/unit/{id}',[UnitController::class,'selectedUnit']);
Route::get('/view/door/{id}',[UnitController::class,'show']);
Route::post('permissions',[PermissionController::class,'store']);
Route::post('/add/myunits',[PermissionController::class,'show']);
Route::post('/make/schedule',[ScheduleController::class,'store']);