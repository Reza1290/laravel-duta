<?php

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Database\Seeders\TestRBACSeeder;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(TestRBACSeeder::class);
});

test('Direktur sebagai admin harus memiliki semua izin', function () {
    $direktur = User::where('cKode', 'US001')->first();

    $this->getJson("/api/users/{$direktur->id}/permissions")
        ->assertStatus(200)
        ->assertJsonPath('user.cName', 'Direktur')
        ->assertJsonPath('permissions.Sales', [
            'view', 'create', 'edit', 'delete', 'report'
        ])
        ->assertJsonCount(4, 'permissions');
});

test('Serly sebagai marketing harus memiliki izin yang benar', function () {
    $serly = User::where('cKode', 'US003')->first();

    $this->getJson("/api/users/{$serly->id}/permissions")
        ->assertStatus(200)
        ->assertJsonPath('user.cName', 'Serly')
        ->assertJsonPath('permissions.Sales', ['view', 'create', 'edit'])
        ->assertJsonPath('permissions.Purchasing', ['view', 'create', 'edit'])
        ->assertJsonMissingPath('permissions.Cash/Bank')
        ->assertJsonCount(2, 'permissions');
});

test('Winda sebagai finance harus memiliki izin yang benar', function () {
    $winda = User::where('cKode', 'US002')->first();

    $this->getJson("/api/users/{$winda->id}/permissions")
        ->assertStatus(200)
        ->assertJsonPath('user.cName', 'Winda')
        ->assertJsonPath('permissions.Cash/Bank', ['view', 'create'])
        ->assertJsonMissingPath('permissions.Sales')
        ->assertJsonCount(1, 'permissions');
});


test('API dapat menetapkan multiple role ke seorang user dan hak aksesnya terupdate', function () {
    $serly = User::where('cKode', 'US003')->first();
    $marketingRole = Role::where('cName', 'Marketing')->first();
    $financeRole = Role::where('cName', 'Finance')->first();

    $this->postJson("/api/users/{$serly->id}/roles", [
        'role_ids' => [$marketingRole->id, $financeRole->id]
    ])
    ->assertStatus(200)
    ->assertJsonPath('message', "Roles for user 'Serly' have been updated.");

    $response = $this->getJson("/api/users/{$serly->id}/permissions");

    $response->assertStatus(200);

    $response->assertJsonPath('permissions.Sales', ['view', 'create', 'edit']);

    $response->assertJsonPath('permissions.Cash/Bank', ['view', 'create']);

    $response->assertJsonCount(3, 'permissions'); 
});
