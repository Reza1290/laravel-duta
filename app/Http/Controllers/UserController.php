<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::with('roles')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cKode' => 'required|string|unique:users,cKode',
            'cName' => 'required|string|max:255',
        ]);

        $user = User::create($validated);
        return response()->json($user, 201);
    }


    public function assignRoles(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($validated['role_ids']);

        return response()->json([
            'message' => "Roles for user '{$user->cName}' have been updated.",
            'user' => $user->load('roles')
        ]);
    }
}
