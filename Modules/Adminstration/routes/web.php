<?php

use Illuminate\Support\Facades\Route;
use Modules\Adminstration\App\Http\Controllers\AdminstrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin1')->group(function () {
   // Route::get('adminstration/index','AdminstrationController@index')->name('adminstration.index');
});
//,'namespace' => 'Modules\Adminstration\Http\Controllers'
Route::group(['middleware' => 'web','domain' => config('app.adminDomain')], function () {
    //Route::resource('adminstration', AdminstrationController::class)->names('adminstration');
   
    //adminstration
    
    Route::get('/welcome', 'AdminstrationController@index')->name('adminstration.index'); 
    Route::get('/welcome/data', 'AdminstrationController@indexData')->name('adminstration.index_data'); 
    Route::get('/welcome/devices/health', 'AdminstrationController@devicesHealth')->name('adminstration.devices_health');
    
    //rooms
    Route::get('/rooms/index', 'RoomsController@index')->name('rooms.index');
    Route::post('/rooms/create','RoomsController@create')->name('room.create');
    Route::get('/rooms/show','RoomsController@show')->name('room.show');
    Route::match(['GET','POST'],'/rooms/doors/edit/blade/{id}','RoomsController@doors_edit_blade')->name('room.door_edit_blade');
    Route::match(['GET','POST'],'/rooms/doors/edit','RoomsController@doors_edit')->name('room.door_edit');
    Route::get('/rooms/doors/{id}', 'RoomsController@doors')->name('rooms.doors');
    Route::get('/rooms/details/update/{id}', 'RoomsController@roomUpdate')->name('rooms.roomUpdate');
    Route::post('/rooms/details/actions/update', 'RoomsController@roomUpdateAction')->name('rooms.roomUpdateAction'); 
    Route::post('/rooms/destroy', 'RoomsController@destroy')->name('rooms.destroy');

    //users
    Route::get('/users/index', 'usersController@index')->name('users.index');
    Route::get('/admin/user/search', 'usersController@search')->name('users.search');

    //permissions
    Route::get('/permissions/show/{id}', 'PermissionsController@show')->name('permissions.show');
});
