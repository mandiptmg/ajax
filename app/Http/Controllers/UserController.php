<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

      /**
     * Instantiate a new UserController instance.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:create -user|edit-user|delete-user', ['only' => ['index','show']]);
    //     $this->middleware('permission:create-user', ['only' => ['create','store']]);
    //     $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
    //     $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
        ];

        // Perform validation
        $validator = validator(
            $request->all(),
            $rules
        );


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            

            return response()->json(['status' => 200, 'message' => 'User Created successfully!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email,'.$id,
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required'
        ];

        // Perform validation
        $validator = validator(
            $request->all(),
            $rules
        );


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            

            return response()->json(['status' => 200, 'message' => 'User Created successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect to the login page or any other page
    }
}
