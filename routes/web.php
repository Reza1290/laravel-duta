<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashBankTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    
    Route::resource('sales-orders', SalesOrderController::class);
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::resource('cash-bank-transactions', CashBankTransactionController::class);
});
