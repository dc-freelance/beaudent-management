<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Frontoffice', 'Manager Cabang', 'Billing', 'Admin Cabang', 'Owner', 'Admin Pusat'];
        Role::insert(array_map(fn ($role) => ['name' => $role], $roles));
    }
}
