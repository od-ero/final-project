<?php

namespace Modules\Adminstration\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        { $users = User::select('*')
            ->orderBy('users.fname', 'asc')
            ->get();

            return view('adminstration::users.index',['users'=> $users]);
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
    public function show($id)
    {
        return view('adminstration::show');
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
