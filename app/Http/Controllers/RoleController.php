<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PermissionCategory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class roleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create', 'store']]);
        $this->middleware('permission:update role', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('role-permission.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissioncategory = PermissionCategory::all();
        $permission = Permission::get();
        return view('role-permission.roles.create', compact('permission', 'permissioncategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array', // Ensure permission is an array
        ]);

        $permissions = $request->input('permission');

        // Create the role
        $role = Role::create(['name' => $request->input('name')]);

        // Ensure permissions exist before syncing
        $validPermissions = Permission::whereIn('id', $permissions)->get();

        // Sync permissions
        $role->syncPermissions($validPermissions);

        return redirect()->route('roles.index')->with('status', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissioncategory = permissioncategory::all();
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('role-permission.roles.show', compact('role', 'rolePermissions', 'permissioncategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $permissioncategory = permissionCategory::all();
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role-permission.roles.edit', compact('role', 'permission', 'rolePermissions', 'permissioncategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required|array',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $permissions = $request->input('permission');
        $validPermissions = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($validPermissions);
        return redirect()->route('roles.index')->with('status', 'Role updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Role::findById($id);
        $roles->delete();

        return redirect()->back()
            ->with('success', 'Role deleted successfully');
    }
}
