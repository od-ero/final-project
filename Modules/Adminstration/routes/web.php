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

    $route = Route::middleware('web');

    if (app()->isLocal()) {
        $route->prefix('admin');
    } else {
        $route->domain(config('app.adminDomain'));
    }

    $route->group(function () {

       
        Route::group(['middleware' => ['guest']], function() {
            Route::get('/login', 'AuthController@show')->name('adminLogin.show');
            Route::post('/auth/login', 'AuthController@login')->name('adminLogin.perform');
        });

        Route::group(['middleware' => ['auth']], function() {
            Route::get('/flush', 'AuthController@logout')->name('adminLogin.Logout');

            //adminstration
            Route::get('/dashboard', 'AdminstrationController@index')->name('adminstration.index');
            Route::get('/dashboard/data', 'AdminstrationController@indexData')->name('adminstration.index_data');
            Route::get('/dashboard/devices/health', 'AdminstrationController@devicesHealth')->name('adminstration.devices_health');

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
            Route::get('/users/index', 'UsersController@index')->name('users.index');
            Route::match(['GET','POST'],'/users/show/{id}','UsersController@show')->name('users.show');
            Route::get('/user/search', 'UsersController@search')->name('users.search');

            //permissions
            Route::get('/permissions/show/{id}', 'PermissionsController@show')->name('permissions.show');

    });
});
