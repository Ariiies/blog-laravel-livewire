<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(12);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all(); 
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create($request->only('name', 'guard_name'));
        $role->permissions()->attach($request->permissions);

        session()->flash('swal', ['icon' => 'success', 'title' => 'Role Created successfully.']);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        
        return view('admin.roles.edit', compact('role', 'permissions'));
    }
  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'guard_name' => 'required|string|max:255',
            'permissions.*' => 'exists:permissions,id', 
        ]);

        $role->update($request->only('name', 'guard_name'));
        $role->permissions()->sync($request->permissions);
        session()->flash('swal', ['icon' => 'success', 'title' => 'Role Updated successfully.']);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('swal', ['icon' => 'success', 'title' => 'Role Deleted successfully.']);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
    
}
