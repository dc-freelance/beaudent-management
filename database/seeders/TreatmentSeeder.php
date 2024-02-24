<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treatment::create([
            'name'      => 'Treatment 1',
            'code' => null,
            'parent_id' => null,
            'is_control' => 1,
            'price'     => 100000,
            'treatment_category_id' => null,
        ]);
    }
}