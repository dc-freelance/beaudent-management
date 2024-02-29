<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Addon::insert([
            [
                'name'           => 'Addon 1',
                'price'          => 1000,
                'fee_percentage' => 10,
                'created_at'     => now(),
            ],
            [
                'name'           => 'Addon 2',
                'price'          => 2000,
                'fee_percentage' => 20,
                'created_at'     => now(),
            ],
            [
                'name'           => 'Addon 3',
                'price'          => 3000,
                'fee_percentage' => 30,
                'created_at'     => now(),
            ],
        ]);
    }
}
