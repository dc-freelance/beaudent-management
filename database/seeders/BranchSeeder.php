<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brances = [
            [
                'code' => 'PST',
                'name' => 'Pusat',
                'address' => 'Address 1',
                'phone_number' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CBG-1',
                'name' => 'Cabang 1',
                'address' => 'Address 2',
                'phone_number' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CBG-2',
                'name' => 'Cabang 2',
                'address' => 'Address 3',
                'phone_number' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Branch::insert($brances);
    }
}
