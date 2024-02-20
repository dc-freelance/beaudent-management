<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ConfigShiftSeeder::class,
            BranchSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            ItemCategorySeeder::class,
            SupplierSeeder::class,
        ]);
    }
}
