<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            User::ADMIN_PUSAT_ROLE,
            User::ADMIN_CABANG_ROLE,
            User::FRONT_OFFICE_ROLE,
            User::MANAGER_CABANG_ROLE,
            User::BILLING_ROLE,
            User::OWNER_ROLE,
        ];

        Role::insert(array_map(fn ($role) => ['name' => $role, 'guard_name' => 'web'], $roles));
    }
}
