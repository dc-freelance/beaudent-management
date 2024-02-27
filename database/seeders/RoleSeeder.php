<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // $roles = [
        //     User::ADMIN_PUSAT_ROLE,
        //     User::ADMIN_CABANG_ROLE,
        //     User::FRONT_OFFICE_ROLE,
        //     User::MANAGER_CABANG_ROLE,
        //     User::BILLING_ROLE,
        //     User::OWNER_ROLE,
        // ];

        // Role::insert(array_map(fn ($role) => ['name' => $role, 'guard_name' => 'web'], $roles));
        $role_admin_pusat = Role::create(['name' => User::ADMIN_PUSAT_ROLE, 'guard_name' => 'web']);
        $role_admin_cabang = Role::create(['name' => User::ADMIN_CABANG_ROLE, 'guard_name' => 'web']);
        $role_front_office = Role::create(['name' => User::FRONT_OFFICE_ROLE, 'guard_name' => 'web']);
        $role_manager_cabang = Role::create(['name' => User::MANAGER_CABANG_ROLE, 'guard_name' => 'web']);
        $role_billing = Role::create(['name' => User::BILLING_ROLE, 'guard_name' => 'web']);
        $role_owner = Role::create(['name' => User::OWNER_ROLE, 'guard_name' => 'web']);
        $role_telemarketing = Role::create(['name' => User::TELEMARKETING_ROLE, 'guard_name' => 'web']);

        $permission_admin_pusat = [
            'read_permission', 'update_permission', 'delete_permission', 'create_permission',
            'read_role', 'update_role', 'delete_role', 'create_role',
            'read_user', 'update_user', 'delete_user', 'create_user'
        ];

        $role_admin_pusat->givePermissionTo($permission_admin_pusat);
    }
}