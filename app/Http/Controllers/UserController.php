<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::all(),
            'user' => new User(),
            'roles' => Role::all(),
        ]);
    }

    public function edit(string $id)
    {
        return view('admin.user.index', [
            'users' => User::all(),
            'user' => User::findOrFail($id),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($request->has('role_ids')) {
            $roles = Role::whereIn('id', $request->role_ids)->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }

        return redirect('/admin/user')->with('updated', 'User Updated!');
    }
}
