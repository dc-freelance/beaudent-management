<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemUnits = [
            // unit for medicine
            [
                'name'       => 'Tablet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Kapsul',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Botol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Strip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Tube',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Vial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Ampul',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Sachet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Tube',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Bottle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Syrup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Tube',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Vial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Ampul',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Sachet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Tube',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Unit::insert($itemUnits);
    }
}
