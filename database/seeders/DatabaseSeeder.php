<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            BranchSeeder::class,
            TreatmentSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            PermissionSeeder::class,
            ItemCategorySeeder::class,
            SupplierSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
