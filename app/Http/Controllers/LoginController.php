<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {

        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {   try{
        $credentials = $request->getCredentials();
        if(!Auth::validate($credentials)):
            $notification= array(
                'alert-type' => 'error',
                'message' => 'Oooops!! These credentials do not match our records.'
                        );
            return redirect()->back()
                 ->with($notification);
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    catch (\Exception $e) {
            $notification = array(
            'alert-type' => 'error',
            'message' => 'Oooops!! an error occurred please try again later'
            );
            return redirect()->back()
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
    {
        return redirect()->intended(route('home.index'));
    }
}
