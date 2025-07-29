<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestRBACSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuMaster = Menu::create(['cKode' => 'MN001', 'cName' => 'Master']);
        $menuSales = Menu::create(['cKode' => 'MN002', 'cName' => 'Sales']);
        $menuPurchasing = Menu::create(['cKode' => 'MN003', 'cName' => 'Purchasing']);
        $menuCashBank = Menu::create(['cKode' => 'MN004', 'cName' => 'Cash/Bank']);
        $allMenus = [$menuMaster, $menuSales, $menuPurchasing, $menuCashBank];

        $actions = ['view', 'create', 'edit', 'delete', 'report'];
        $permissionKodeCounter = 1;
        foreach ($allMenus as $menu) {
            foreach ($actions as $action) {
                Permission::create([
                    'cKode' => 'P' . str_pad($permissionKodeCounter++, 2, '0', STR_PAD_LEFT),
                    'cName' => $action,
                    'menu_id' => $menu->id,
                ]);
            }
        }

        $roleDirektur = Role::create(['cKode' => 'RL001', 'cName' => 'Direktur']);
        $roleMarketing = Role::create(['cKode' => 'RL002', 'cName' => 'Marketing']);
        $roleFinance = Role::create(['cKode' => 'RL003', 'cName' => 'Finance']);

        $userDirektur = User::create(['cKode' => 'US001', 'cName' => 'Direktur']);
        $userWinda = User::create(['cKode' => 'US002', 'cName' => 'Winda']);
        $userSerly = User::create(['cKode' => 'US003', 'cName' => 'Serly']);

        $marketingPermissions = Permission::whereIn('menu_id', [$menuSales->id, $menuPurchasing->id])
            ->whereIn('cName', ['view', 'create', 'edit'])
            ->pluck('id');
        $roleMarketing->permissions()->sync($marketingPermissions);

        $financePermissions = Permission::where('menu_id', $menuCashBank->id)
            ->whereIn('cName', ['view', 'create'])
            ->pluck('id');
        $roleFinance->permissions()->sync($financePermissions);

        $allPermissionIds = Permission::pluck('id');
        $roleDirektur->permissions()->sync($allPermissionIds);


        $userDirektur->roles()->sync([$roleDirektur->id]);
        $userWinda->roles()->sync([$roleFinance->id]);
        $userSerly->roles()->sync([$roleMarketing->id]);
    }
}
