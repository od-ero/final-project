<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DoorStatusSetter;
use App\Models\Door;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adminstration::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminstration::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($door_id)
    {  $door_id = base64_decode($door_id);
        //dd($door_id);
        $unit_id= Door::where('id',$door_id)->pluck('unit_id');
        $door_name= Door::where('id',$door_id)->value('door_name');
        $door_logs = DoorStatusSetter::leftJoin('my_permissions', 'my_permissions.id', '=', 'door_status_setters.my_permission_id')
                                    ->leftJoin('door_schedules', 'door_schedules.id', '=', 'door_status_setters.door_schedule_id')
                                    ->leftJoin('users', 'door_status_setters.user_id', '=', 'users.id')
                                    ->leftJoin('users as uP', 'my_permissions.permissioner_id', '=', 'uP.id')
                                    ->leftJoin('users as uS', 'door_schedules.user_id', '=', 'uS.id')
                                    ->select(
                                        'door_status_setters.status',
                                        'door_status_setters.created_at',
                                        'users.fname',
                                        'users.lname',
                                        'uP.fname as pfname',
                                        'uP.lname as plname',
                                        'uS.fname as sfname',
                                        'uS.lname as slname'
                                    )
                                    ->where('door_status_setters.door_id', $door_id)
                                    ->orderBy('door_status_setters.created_at','desc')
                                    ->get()
                                    ->map(function ($log) {
                                        // Determine permissioner name based on which one has a value
                                        $permissioner_fname = $log->pfname ?? $log->sfname;
                                        $permissioner_lname = $log->plname ?? $log->slname;
                                
                                        return [
                                            'status' => $log->status,
                                            'created_at' => $log->created_at,
                                            'fname' => $log->fname,
                                            'lname' => $log->lname,
                                            'permissioner_fname' => $permissioner_fname,
                                            'permissioner_lname' => $permissioner_lname,
                                        ];
                                    });
        return view('adminstration::permissions.door_logs',['door_logs'=>$door_logs, 'door_name'=>$door_name, 'nav_unit_id'=>$unit_id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('adminstration::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
