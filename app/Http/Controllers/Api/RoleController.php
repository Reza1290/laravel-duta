<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::with('permissions.menu')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cKode' => 'required|string|unique:roles,cKode',
            'cName' => 'required|string|max:255',
        ]);

        $role = Role::create($validated);
        return response()->json($role, 201);
    }

    public function assignPermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id', 
        ]);

        $role->permissions()->sync($validated['permission_ids']);

        return response()->json([
            'message' => "Permissions for role '{$role->cName}' have been updated.",
            'role' => $role->load('permissions.menu') 
        ]);
    }
}
