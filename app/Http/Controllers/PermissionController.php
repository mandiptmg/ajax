<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        return view('role-permission.permission.index', compact('permissions'));
    }

    public function store(Request $request)
    {


        $rules = [
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
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

            $permission = new Permission();
            $permission->name = $request->name;

            $permission->save();
            return response()->json(['status' => 200, 'message' => 'Permission Created successfully!']);
            
        }
    }


    public function update(Request $request, String $id)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
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

            $permission =  Permission::findOrFail($id); 
            $permission->name = $request->name;
            $permission->save();
            return response()->json(['status' => 200, 'message' => 'Permission update successfully!']);

        }
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('status', 'Permission Deleted Successfully');
    }
}
