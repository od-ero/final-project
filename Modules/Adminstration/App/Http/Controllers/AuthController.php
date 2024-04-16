<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        if (!Auth::check()) {
            return view('adminstration::auth.login');
        } else {
            $notification = array(
                'message'    => 'Login succesful',
                'alert-type' => 'success',
            );
            return redirect()->route('adminstration.index')->with($notification);
           }
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {    
        $credentials = $request->getCredentials();
//dd($credentials);

        if(!Auth::validate($credentials)):
            $notification= array(
                'alert-type' => 'error',
                'message' => 'Oooops!! These credentials do not match our records.'
                        );
            return redirect()->to('/admin/login')
                 ->with($notification);
            
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
//dd($user->admin);
        if($user->role_id!=1){
            Auth::login($user);

            return $this->authenticated($request, $user);}
            else{
                $notification= array(
                    'alert-type' => 'error',
                    'message' => 'Oooops!! Kindly login via the general page at '. env('USERS_DOMAIN')
                            );
                return redirect()->to('/admin/login')
                     ->with($notification);
            }
    }
   
    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {//dd('auth');
        return redirect()->intended();
    }

    /**
     * Store a newly created resource in storage.
     */

     public function logout()
     {
         Session::flush();
         
         Auth::logout();
         $notification = array(
            'message'    => 'You Have Logged Out Succesful',
            'alert-type' => 'success',
        );
         return redirect()->to('/admin/login')->with($notification);
     }
     public function store(Request $request): RedirectResponse
    {
        //
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
