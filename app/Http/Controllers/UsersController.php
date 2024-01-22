<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Auth;


class UsersController extends Controller
{
  public function test(){
    return response()->json([
      'Password' => '12wq',
      'user' => 'ttttt'
  ]);

  }
  
  public function index()
  {
  return view('search.search');
  }
 
    public function search(Request $request)
    {
      $search = $request->input('search');
    if($request->ajax())
    {
    $output="";
    $details = User::query()
    ->where('email', 'LIKE', "%{$search}%")
    ->orWhere('phone', 'LIKE', "%{$search}%")
    ->get();
    if($details)
    {
    foreach ($details as $key => $product) {
    $output.='<tr>'.
    '<td>'.$product->id.'</td>'.
    '<td>'.$product->lname.'</td>'.
    '<td>'.$product->email.'</td>'.
    '<td>'.$product->price.'</td>'.
    '</tr>';
    }
    return Response($output);
       }
       }
    }
    
     
  
  
  public function search1(Request $request){
    // Get the search value from the request
    $search = $request->input('search');

    // Search in the title and body columns from the posts table
    $posts = User::query()
        ->where('email', 'LIKE', "%{$search}%")
        ->orWhere('phone', 'LIKE', "%{$search}%")
        ->get();

    // Return the search view with the resluts compacted
    return view('search.search', compact('posts'));
}
  public function login(Request $request){
    if ($request->isMethod('get')) {
      // dd($request->isMethod('get'));
      return view('login');
  } 
  else{
          if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
              $user = Auth::user();
              $success['token'] = $user->createToken('appToken')->accessToken;
  
              return response()->json([
                  'success' => true,
                  'token' => $success,
                  'user' => $user
              ]);
          } else {
              return response()->json([
                  'success' => false,
                  'message' => 'Invalid Email or Password',
              ], 401);
          }
     
      }
      }
  
    public function register(Request $request)
    {
      if ($request->isMethod('get')) {
        // dd($request->isMethod('get'));
        return view('register');
    } 
    else{
    // dd( $request->all());
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
          return view('register');
         // return response()->json([
           // 'success' => false,
           // 'message' => $validator->errors(),
        //  ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('appToken')->accessToken;
        return view('login');
        //return response()->json([
          //'success' => true,
          //'message' => 'registration successfull'
     // ]);
      }
    }
    public function logout(Request $res)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }
}
