<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminRoleIds = [2];

    public function index()
    {
        $admins = User::whereIn('role_id', $this->adminRoleIds)->get();
        return view('roles.SuperAdmin.admin.index', compact('admins'));
    }

    public function create()
    {
        $adminRoles = Role::whereIn('id', $this->adminRoleIds)->get();
        return view('roles.SuperAdmin.admin.create', compact('adminRoles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id'
        ]);

        User::create($validated);

        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function show(User $admin)
    {
        return view('roles.SuperAdmin.admin.show', compact('admin'));
    }

    public function edit(User $admin)
    {
        $adminRoles = Role::whereIn('id', $this->adminRoleIds)->get();
        return view('roles.SuperAdmin.admin.edit', compact('admin','adminRoles'));
    }

    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username,' . $admin->username,
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
        ]);

        $admin->update($validated);

        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil diupdate.');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
