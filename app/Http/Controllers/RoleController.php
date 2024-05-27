<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return view('role-permission.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {


        $rules = [
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
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

            $permission = new Role();
            $permission->name = $request->name;

            $permission->save();
            return response()->json(['status' => 200, 'message' => 'Role Created successfully!']);
            
        }
    }


    public function update(Request $request, String $id)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
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

            $permission = Role::findOrFail($id) ;
            $permission->name = $request->name;
            $permission->save();
            return response()->json(['status' => 200, 'message' => 'Role update successfully!']);

        }
    }

    public function destroy($id)
    {
        $permission = Role::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('status', 'Role Deleted Successfully');
    }
}