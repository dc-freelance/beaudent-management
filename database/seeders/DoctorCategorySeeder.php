<?php

namespace Database\Seeders;

use App\Models\DoctorCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorCategorySeeder extends Seeder
{
    public function run(): void
    {
        DoctorCategory::insert([
            ['name' => 'General Physician'],
            ['name' => 'Dentist'],
            ['name' => 'Cardiologist'],
            ['name' => 'Dermatologist'],
            ['name' => 'Gynecologist'],
            ['name' => 'Neurologist'],
            ['name' => 'Ophthalmologist'],
            ['name' => 'Orthopedic'],
            ['name' => 'Pediatrician'],
            ['name' => 'Psychiatrist'],
            ['name' => 'Surgeon'],
            ['name' => 'Urologist'],
        ]);
    }
}
