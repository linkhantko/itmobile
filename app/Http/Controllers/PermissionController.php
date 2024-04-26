<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permission.index', [
            'permissions' => Permission::all(),
            'permission' => new Permission(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        Permission::create($data);

        return redirect('/admin/permission')->with('success', 'New Permission Added!');
    }

    public function edit(string $id)
    {
        return view('admin.permission.index', [
            'permissions' => Permission::all(),
            'permission' => Permission::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        Permission::findOrFail($id)->update($data);

        return redirect('/admin/permission')->with('updated', 'Permission Updated!');
    }

    public function destroy(string $id)
    {
        Permission::findOrFail($id)->delete();

        return back()->with('deleted', 'successfully deleted!');
    }
}
