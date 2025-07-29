<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionedController extends Controller
{

    protected string $resourceName = ''; 

    public function __construct()
    {
        $map = [
            'index'   => 'view',
            'show'    => 'view',
            'create'  => 'create',
            'store'   => 'create',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'delete',
        ];

        foreach ($map as $method => $permission) {
            if (method_exists($this, $method)) {
                $this->middleware("permission:$permission,{$this->resourceName}")->only($method);
            }
        }
    }
}
