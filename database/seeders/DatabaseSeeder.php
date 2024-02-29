<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ConfigShiftSeeder::class,
            BranchSeeder::class,
            DoctorCategorySeeder::class,
            DoctorSeeder::class,
            DoctorScheduleSeeder::class,
            TreatmentSeeder::class,
            CustomerSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ItemCategorySeeder::class,
            SupplierSeeder::class,
            ReservationSeeder::class,
            PaymentMethodsSeeder::class,
            // TransactionSeeder::class,
            OdontogramSeeder::class,
        ]);

        // \App\Models\Item::factory(100)->create();
    }
}
