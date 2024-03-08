<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        Doctor::create([
            'name'         => 'Dr. John Doe',
            'email'        => 'jhon@mail.com',
            'phone_number' => '1234567890',
            'join_date'    => '2021-01-01',
            'password'     => bcrypt('password'),
            'category_id'  => 1,
        ]);
    }
}
