<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    public function run(): void
    {
        DoctorSchedule::create([
            'doctor_id' => Doctor::first()->id,
            'branch_id' => 1,
            'date'      => '2024-02-17',
            'shift'     => 'Pagi',
        ]);
    }
}
