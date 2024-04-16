<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        { $user_role_id= User::where('id',Auth::id())
                                ->value('role_id');
            $users = User::leftJoin('roles','roles.id','=','users.role_id')
                        ->where('role_id','<', $user_role_id)
                        ->select('users.*','roles.role_name')
                        ->orderBy('users.fname', 'asc')
                        ->get();
            
            return view('adminstration::users.index',['users'=> $users,
                                                    'user_role_id'=>$user_role_id]);
    }
    public function search(Request $request)
    {
        // Get the search terms from the request
        $name = $request->input('term1');
        $phone = $request->input('term2');
    
        // Perform your search logic
        $results = User::query()
                  ->where('fname', 'LIKE', "%{$name}%")
                  ->orWhere('lname', 'LIKE', "%{$name}%")
                  ->where('phone', 'LIKE', "%{$phone}%")
                  ->get();
                 // dd($results);
        // Process the results
        $formattedResults = $results->map(function ($result) {
            $displayName = $result->fname . ' ' . $result->lname;
            
            return [
                'id' => $result->id,
                'displayPhone' => $result->phone,
                'displayName' => $displayName,
            ];
        });
        return response()->json($formattedResults);
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
    public function show(Request $request, $user_id)
    {$user_id=base64_decode($user_id);
        if ($request->isMethod('get')) {
        $user = User::leftJoin('roles','roles.id','=','users.role_id')
                        ->where('users.id', $user_id)
                        ->select('users.*','roles.role_name')
                        ->first();
        $user_role_id= User::where('id',Auth::id())
                        ->value('role_id');                
        $roles= Role::where('id','<',$user_role_id)
                        ->select('*')
                        ->get();        
        return view('adminstration::users.edit_admin',['user'=>$user,
                                                        'roles'=>$roles ]);
                                        
        }else{
            $roles= $request->all();
                DB::beginTransaction();
                try{
                    User::where('id',$user_id)
                        ->update(['role_id'=> $roles['role_id']]);
            
        
                    DB::commit();
                        $notification = array(
                            'message'    => 'User role updated succesful',
                            'alert-type' => 'success',
                        );
                        
                        
                            
                        
                            }
                            
                            catch (\Exception $e) {
                                DB::rollback();
                                $notification = array(
                                    'message'    => 'Ooops!! an error occurred while processing your request.',
                                    'alert-type' => 'error',
                        );
                            }
            return redirect()->back()->with($notification);

        }
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
