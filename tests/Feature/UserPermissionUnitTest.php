<?php

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Database\Seeders\TestRBACSeeder;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(TestRBACSeeder::class);
});

test('logika direktur harus memiliki semua izin', function () {
    $direktur = User::where('cKode', 'US001')->first();

    expect($direktur->hasPermissionTo('create', 'Sales'))->toBeTrue();
    expect($direktur->hasPermissionTo('edit', 'Sales'))->toBeTrue();
    expect($direktur->hasPermissionTo('delete', 'Sales'))->toBeTrue();
    expect($direktur->hasPermissionTo('report', 'Sales'))->toBeTrue();
    expect($direktur->hasPermissionTo('create', 'Purchasing'))->toBeTrue();
    expect($direktur->hasPermissionTo('edit', 'Purchasing'))->toBeTrue();
    expect($direktur->hasPermissionTo('delete', 'Purchasing'))->toBeTrue();
    expect($direktur->hasPermissionTo('report', 'Purchasing'))->toBeTrue();
    expect($direktur->hasPermissionTo('create', 'Master'))->toBeTrue();
    expect($direktur->hasPermissionTo('edit', 'Master'))->toBeTrue();
    expect($direktur->hasPermissionTo('delete', 'Master'))->toBeTrue();
    expect($direktur->hasPermissionTo('report', 'Master'))->toBeTrue();
    expect($direktur->hasPermissionTo('create', 'Cash/Bank'))->toBeTrue();
    expect($direktur->hasPermissionTo('edit', 'Cash/Bank'))->toBeTrue();
    expect($direktur->hasPermissionTo('delete', 'Cash/Bank'))->toBeTrue();
    expect($direktur->hasPermissionTo('report', 'Cash/Bank'))->toBeTrue();
});

test('logika Serly sebagai marketing harus memiliki izin yang benar', function () {
    $serly = User::where('cKode', 'US003')->first();

    expect($serly->hasPermissionTo('create', 'Sales'))->toBeTrue();
    expect($serly->hasPermissionTo('edit', 'Purchasing'))->toBeTrue();
    expect($serly->hasPermissionTo('view', 'Sales'))->toBeTrue();

    expect($serly->hasPermissionTo('delete', 'Sales'))->toBeFalse(); 
    expect($serly->hasPermissionTo('view', 'Cash/Bank'))->toBeFalse(); 
});

test('logika Winda sebagai finance harus memiliki izin yang benar', function () {
    $winda = User::where('cKode', 'US002')->first();

    expect($winda->hasPermissionTo('create', 'Cash/Bank'))->toBeTrue();
    expect($winda->hasPermissionTo('view', 'Cash/Bank'))->toBeTrue();

    expect($winda->hasPermissionTo('edit', 'Cash/Bank'))->toBeFalse(); 
    expect($winda->hasPermissionTo('view', 'Sales'))->toBeFalse(); 
});


test('User X dengan role Marketing dan Finance harus memiliki gabungan izin yang benar', function () {
    $marketingRole = Role::where('cName', 'Marketing')->first();
    $financeRole = Role::where('cName', 'Finance')->first();

    $userX = User::create(['cKode' => 'US004', 'cName' => 'User X']);

    $userX->roles()->sync([$marketingRole->id, $financeRole->id]);

    expect($userX->hasPermissionTo('create', 'Sales'))->toBeTrue();
    expect($userX->hasPermissionTo('edit', 'Purchasing'))->toBeTrue();

    expect($userX->hasPermissionTo('create', 'Cash/Bank'))->toBeTrue();

    expect($userX->hasPermissionTo('delete', 'Sales'))->toBeFalse();
    expect($userX->hasPermissionTo('edit', 'Cash/Bank'))->toBeFalse();
});

test('User Z role Marketing dan Finance mengaksses Master false', function () {
    $marketingRole = Role::where('cName', 'Marketing')->first();
    $financeRole = Role::where('cName', 'Finance')->first();

    $userX = User::create(['cKode' => 'US005', 'cName' => 'User Z']);

    $userX->roles()->sync([$marketingRole->id, $financeRole->id]);

    expect($userX->hasPermissionTo('create', 'Sales'))->toBeTrue();
    expect($userX->hasPermissionTo('edit', 'Purchasing'))->toBeTrue();

    expect($userX->hasPermissionTo('create', 'Cash/Bank'))->toBeTrue();

    expect($userX->hasPermissionTo('delete', 'Sales'))->toBeFalse();
    expect($userX->hasPermissionTo('edit', 'Cash/Bank'))->toBeFalse();

    expect($userX->hasPermissionTo('create', 'Master'))->toBeFalse();
});
