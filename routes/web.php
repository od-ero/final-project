<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::post('login',[UsersController::class,'login']);
Route::post('register',[UsersController::class,'register']);
Route::get('logout',[UsersController::class,'logout']);
Route::post('units',[UnitController::class,'create']);
Route::post('permissions',[PermissionController::class,'store']);
Route::post('/add/myunits',[PermissionController::class,'show']);
Route::post('/make/schedule',[ScheduleController::class,'store']);