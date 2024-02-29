<?php

namespace Database\Seeders;

use App\Models\Examination;
use Illuminate\Database\Seeder;

class ExaminationSeeder extends Seeder
{
    public function run(): void
    {
        Examination::create([
            'medical_record_id' => 1,
            'customer_id' => 1,
            'examination_date' => '2024-02-28',
            'systolic_blood_pressure' => 120.5,
            'diastolic_blood_pressure' => 80.2,
            'blood_type' => 'A',
            'heart_disease' => 0,
            'diabetes' => 1,
            'blood_clotting_disorder' => 0,
            'hepatitis' => 0,
            'digestive_diseases' => 0,
            'other_diseases' => 0,
            'allergies_to_medicines' => 1,
            'medications' => 'Aspirin, Vitamin C',
            'allergies_to_food' => 1,
            'foods' => 'Peanuts, Shellfish',
            'reservation_id' => 1,
            'doctor_id' => 1
        ]);

        Examination::create([
            'medical_record_id' => 2,
            'customer_id' => 2,
            'examination_date' => '2024-02-29',
            'systolic_blood_pressure' => 125.8,
            'diastolic_blood_pressure' => 85.1,
            'blood_type' => 'B',
            'heart_disease' => 1,
            'diabetes' => 0,
            'blood_clotting_disorder' => 1,
            'hepatitis' => 0,
            'digestive_diseases' => 0,
            'other_diseases' => 1,
            'allergies_to_medicines' => 0,
            'medications' => 'Metformin',
            'allergies_to_food' => 0,
            'foods' => null,
            'reservation_id' => 2,
            'doctor_id' => 1
        ]);

        Examination::create([
            'medical_record_id' => 1,
            'customer_id' => 1,
            'examination_date' => '2024-02-29',
            'systolic_blood_pressure' => 110.2,
            'diastolic_blood_pressure' => 70.5,
            'blood_type' => 'AB',
            'heart_disease' => 0,
            'diabetes' => 1,
            'blood_clotting_disorder' => 0,
            'hepatitis' => 1,
            'digestive_diseases' => 0,
            'other_diseases' => 0,
            'allergies_to_medicines' => 1,
            'medications' => 'Insulin',
            'allergies_to_food' => 1,
            'foods' => 'Dairy',
            'reservation_id' => 3,
            'doctor_id' => 1
        ]);
    }
}
