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
            DoctorCategorySeeder::class,
            DoctorSeeder::class,
            DoctorScheduleSeeder::class,
            TreatmentSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            PermissionSeeder::class,
            ItemCategorySeeder::class,
            SupplierSeeder::class,
            ReservationSeeder::class,
            PaymentMethodsSeeder::class,
        ]);
    }
}
