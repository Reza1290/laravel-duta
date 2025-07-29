<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends PermissionedController
{
    protected string $resourceName = 'master';

    public function index()
    {
        $roles = Role::withCount('permissions')->latest()->paginate(10);
        return view('roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::with('menu')->get()->groupBy('menu.cName');
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cKode' => 'required|string|max:255|unique:roles,cKode',
            'cName' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create($request->only('cKode', 'cName'));

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil dibuat.');
    }


    public function edit(Role $role)
    {
        $permissions = Permission::with('menu')->get()->groupBy('menu.cName');

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'cKode' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'cName' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update($request->only('cKode', 'cName'));

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil diperbarui.');
    }


    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return back()->with('error', 'Role tidak bisa dihapus karena masih digunakan oleh user.');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}
