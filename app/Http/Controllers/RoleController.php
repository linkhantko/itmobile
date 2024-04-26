<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.index', [
            'roles' => Role::all(),
            'role' => new Role(),
            'permissions' => Permission::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        Role::create($data);

        return redirect('/admin/role')->with('success', 'New Role Added!');
    }

    public function edit(string $id)
    {
        return view('admin.role.index', [
            'role' => Role::findOrFail($id),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ]);
        $role->update($data);

        if ($request->has('permission_ids')) {
            $permissions = Permission::whereIn('id', $request->permission_ids)->get();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect('/admin/role')->with('updated', 'Role Updated!');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return back()->with('deleted', 'successfully deleted!');
    }
}
