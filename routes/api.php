<?php

use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserPermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/roles', [RoleController::class, 'index']);
Route::post('/roles', [RoleController::class, 'store']);
Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermissions']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/users/{user}/roles', [UserController::class, 'assignRoles']);

Route::get('/users/{user}/permissions', [UserPermissionController::class, 'getPermissionsForUser']);
