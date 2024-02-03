
<?php
/*
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ScheduleController;

*/

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

/*

Route::get('/', function () {
    return view('register');
});


Route::match(['GET','POST'],'/login',[UsersController::class,'login']);
Route::match(['GET','POST'],'/register',[UsersController::class,'register']);
Route::get('/logout',[UsersController::class,'logout']);
Route::match(['GET','POST'],'/units/create',[UnitController::class,'create']);
Route::get('/home/myunits',[UnitController::class,'index']);
Route::match(['GET','update','POST'],'/home/myunits/action/{id}',[UnitController::class,'update']);
Route::get('/selected/unit/{id}',[UnitController::class,'selectedUnit']);
Route::get('/view/door/{id}',[UnitController::class,'show']);
Route::post('permissions',[PermissionController::class,'store']);
Route::post('/add/myunits',[PermissionController::class,'show']);
Route::post('/make/schedule',[ScheduleController::class,'store']);

*/


use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/home/data', 'HomeController@index_data')->name('home.index.data');
    Route::get('/home/myunits','UnitController@index')->name('home.login.index');
    Route::match(['GET','POST'],'/units/create','UnitController@create')->name('unit.create');

Route::match(['GET','update','POST'],'/home/myunits/action/{id}/{permission_id}/{status}','UnitController@update')->name('unit.update');
Route::get('/selected/unit/{id}','UnitController@selectedUnit')->name('unit.selected');
Route::get('/selected/unit/data/{id}','UnitController@selectedUnitData')->name('unit.selected.data');
Route::get('/view/door/{id}','UnitController@show')->name('unit.show');
Route::match(['GET','update','POST'],'add/permissions/{id}','PermissionController@store')->name('permissons.store');
Route::post('/add/myunits','PermissionController@show')->name('permissons.show');
Route::post('/add/creates/permission','PermissionController@create')->name('permissons.create');
Route::match(['GET','update','POST'], '/make/schedule/{id}','ScheduleController@store')->name('schedule.store');
Route::match(['GET','update','POST'], '/user/search','UsersController@search')->name('search');
Route::get('/ajax/search','UsersController@index');
Route::get('/search','UsersController@search');


    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});