<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ScheduleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::post('login',[UsersController::class,'login']);
    Route::post('register',[UsersController::class,'register']);
    Route::get('logout',[UsersController::class,'logout']);
    Route::post('units',[UnitController::class,'create']);
    Route::post('permissions',[PermissionController::class,'store']);
    Route::post('/add/myunits',[PermissionController::class,'show']);
    Route::post('/make/schedule',[ScheduleController::class,'store']);
    Route::post('/schedule/permissions/check/{id}/{action}',[ScheduleController::class,'update']);
    Route::get('/door/state/check/{id}',[ScheduleController::class,'update']);

    
});