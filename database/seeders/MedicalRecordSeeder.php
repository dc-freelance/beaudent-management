<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    public function run(): void
    {
        MedicalRecord::create([
            'medical_record_number' => 'A7U29JH',
            'customer_id' => 1,
            'branch_id' => 2
        ]);

        MedicalRecord::create([
            'medical_record_number' => 'B45HKKW',
            'customer_id' => 2,
            'branch_id' => 2
        ]);
    }
}
