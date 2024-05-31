<?php

namespace App\Http\Controllers;

use App\Models\PermissionCategory;
use Illuminate\Http\Request;

class PermissionCategoryController extends Controller
{
    public function index()
    {
        $permissioncategorys = PermissionCategory::get();
        return view('role-permission.permission-category.index', compact('permissioncategorys'));
    }

    public function store(Request $request)
    {


        $rules = [
            'name' => 'required|string|unique:permission_categories,name'
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

            $permissioncategory = new PermissionCategory();
            $permissioncategory->name = $request->name;

            $permissioncategory->save();
            return response()->json(['status' => 200, 'message' => 'PermissionCategory Created successfully!']);
        }
    }


    public function update(Request $request, String $id)
    {
        $rules = [
            'name' =>'required|string|unique:permission_categories,name'
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

            $permissioncategory =  PermissionCategory::findOrFail($id);
            $permissioncategory->name = $request->name;
            $permissioncategory->save();
            return response()->json(['status' => 200, 'message' => 'PermissionCategory update successfully!']);
        }
    }

    public function destroy($id)
    {
        $permissioncategory = PermissionCategory::findOrFail($id);
        $permissioncategory->delete();
        return redirect()->back()->with('status', 'PermissionCategory Deleted Successfully');
    }
}
