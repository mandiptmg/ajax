<?php

namespace App\Http\Controllers;

use App\Models\PermissionCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    
    {
        $this->middleware('permission:view permission|create permission|update permission|delete permission', ['only' => ['index','store']]);
        $this->middleware('permission:create permission', ['only' => ['create','store']]);
        $this->middleware('permission:update permission', ['only' => ['edit','update']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $permissions = Permission::with('permissionCategory')->paginate(10);
            $permissionCategories = PermissionCategory::all();
            return view('role-permission.permission.index', compact('permissions', 'permissionCategories'));
        }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'permissioncategory_id' => 'required|exists:permission_categories,id',
        ]);

        $permission = new Permission();
        $permission->name = $validatedData['name'];
        $permission->permissioncategory_id = $validatedData['permissioncategory_id'];
        $permission->guard_name = 'web'; // or whatever guard you use
        $permission->save();
        return response()->json(['status' => 200, 'message' => 'Permission Created successfully!']);
    }

    public function update(Request $request, String $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id,
            'permissioncategory_id' => 'required|exists:permission_categories,id',
        ]);


        $permission = Permission::findOrFail($id);
        $permission->name = $validatedData['name'];
        $permission->permissioncategory_id = $validatedData['permissioncategory_id'];
        $permission->save();

        return response()->json(['status' => 200, 'message' => 'Permission Updated successfully!']);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('status', 'Permission Deleted Successfully');
    }
}
