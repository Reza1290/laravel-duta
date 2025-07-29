<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function getPermissionsForUser(User $user)
    {
        $userWithRoles = $user->load('roles.permissions.menu');

        $formattedPermissions = [];

        foreach ($userWithRoles->roles as $role) {
            foreach ($role->permissions as $permission) {
                $menuName = $permission->menu->cName;
                $permissionName = $permission->cName;

                if (!isset($formattedPermissions[$menuName])) {
                    $formattedPermissions[$menuName] = [];
                }

                if (!in_array($permissionName, $formattedPermissions[$menuName])) {
                    $formattedPermissions[$menuName][] = $permissionName;
                }
            }
        }

        return response()->json([
            'user' => [
                'id' => $user->id,
                'cKode' => $user->cKode,
                'cName' => $user->cName,
            ],
            'permissions' => $formattedPermissions
        ]);
    }
}
