
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
Route::group(['domain' => config('app.adminDomain')], function () {
    Route::get("/home",function(){
        return redirect("welcome");
    });

    Route::get("/",function(){
        return redirect("welcome");
    });
});

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/{id}/schedule/permissions/check/{action}','ScheduleController@update')->name('schedule.update');
Route::get('/{id}/door/state/check','ScheduleController@index')->name('schedule.index');
Route::get('/chat', 'HomeController@chart')->name('chat.index');  
Route::get('/chat/data', 'HomeController@chartData')->name('chat.data');  
Route::get('/test/server', 'HomeController@testServer')->name('testserver');  
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
// HomeController Routes
Route::get('/home/data', 'HomeController@index_data')->name('home.index.data');

// LogoutController Route
Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

// PermissionController Routes
Route::match(['GET','POST'],'/add/permissions/{id}','PermissionController@store')->name('permissions.store');
Route::post('/add/myunits','PermissionController@show')->name('permissions.show');
Route::post('/add/creates/permission','PermissionController@create')->name('permissions.create');
Route::get('/permissions/guests/permission/{id}','PermissionController@myPermissions')->name('permissions.myPermissions');
Route::get('/permissions/guests/permission/data/{id}','PermissionController@myPermissionsData')->name('permissions.myPermissions_data');
Route::match(['GET','POST'],'/permissions/edit/guests/permissions/{id}/{selectId}', 'PermissionController@editMyPermissions')->name('permissions.editMyPermissions');
Route::post('/permissions/selected/destroy','PermissionController@destroy')->name('permissions.destroy');
Route::get('/permissions/permission/groups/get/{id}','PermissionController@permissionGroups')->name('permissions.permissionGroups');
Route::match(['GET','POST'],'/groups/me/permissions/update/{id}/{selectId}', 'PermissionController@editPermissionGroup')->name('permissions.editPermissionGroup');
Route::post('/permissions/groups/destroy','PermissionController@PermissionGroupdestroy')->name('permissions.PermissionGroupdestroy');
Route::get('/permissions/groups/data','PermissionController@permissionGroupsData')->name('permissions.permissionGroupsData');
Route::match(['GET','POST'],'/groups/me/create/permissions/{id}', 'PermissionController@addPermissionGroup')->name('permissions.addPermissionGroup');

// ScheduleController Route
Route::match(['GET','POST'], '/make/schedule/{id}','ScheduleController@store')->name('schedule.store');
Route::get('/schedule/groups/{id}','ScheduleController@scheduleGroups')->name('schedule.scheduleGroups');
Route::get('/data/user/schedule/groups','ScheduleController@scheduleGroupsData')->name('schedule.scheduleGroupsData');
Route::get('/units/schedule/permissions/{id}','ScheduleController@doorSchedulePermissions')->name('schedule.doorSchedulePermissions');
Route::get('/schedule/permissions/door/data/{id}','ScheduleController@doorSchedulePermissionsData')->name('schedule.doorSchedulePermissionsData');
Route::match(['GET','POST'],'/update/groups/schedules/{id}/{sch}','ScheduleController@editScheduleGroup')->name('schedule.editScheduleGroup');
Route::match(['GET','POST'],'/update/schedule/user/{id}/{sch}','ScheduleController@editSchedule')->name('schedule.editSchedule');
// UnitController Routes
Route::get('/home/myunits','UnitController@index')->name('units.index');
Route::match(['GET','UPDATE','POST'],'/units/create','UnitController@create')->name('units.create');
Route::match(['GET','UPDATE','POST'],'/home/myunits/action/{id}/{permission_id}/{status}/{latitude}/{longitude}','UnitController@update')->name('units.update');
Route::get('/selected/unit/{id}','UnitController@selectedUnit')->name('units.selected');
Route::get('/selected/unit/data/{id}','UnitController@selectedUnitData')->name('units.selected.data');
Route::get('/view/door/{id}','UnitController@show')->name('units.show');
Route::get('/response/view','UnitController@index')->name('units.index');

// UsersController Routes
Route::match(['GET','UPDATE','POST'], '/user/search','UsersController@search')->name('users.search');
Route::get('/ajax/search','UsersController@index')->name('users.ajax.index');
Route::get('/search','UsersController@search')->name('users.search');

// GlobalController Routes
Route::get('/get/unit/ipAddresses/{id}','GlobalController@index')->name('global.index');
Route::get('/get/unit/ipAddresses/data/{id}','GlobalController@index_data')->name('global.index_data');
Route::match(['GET','UPDATE','POST'], '/units/ipAdress/add','GlobalController@create')->name('global.create');
Route::post('/units/doors/ip/update','GlobalController@update')->name('global.update');
Route::get('/units/doors/ip/show/{id}/{permission_id}','GlobalController@show')->name('global.show');


});
});