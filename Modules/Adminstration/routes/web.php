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
    Route::get('adminstration/index','AdminstrationController@index')->name('adminstration.index');
});
//,'namespace' => 'Modules\Adminstration\Http\Controllers'
Route::group(['middleware' => 'web','domain' => config('app.adminDomain')], function () {
    //Route::resource('adminstration', AdminstrationController::class)->names('adminstration');
    Route::get('adminstration/index','AdminstrationController@index')->name('adminstration.index');
    Route::get('/welcome', 'AdminstrationController@chart')->name('chat.index');  
Route::get('/welcome/data', 'AdminstrationController@chartData')->name('chat.data');  
Route::get('/test/server', 'AdminstrationController@testServer')->name('testserver');
});
