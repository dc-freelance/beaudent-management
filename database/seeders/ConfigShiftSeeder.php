<?php

namespace Database\Seeders;

use App\Models\ConfigShift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigShiftSeeder extends Seeder
{
    public function run(): void
    {
        ConfigShift::insert([
            [
                'name'       => 'Shift 1',
                'start_time' => '09:00:00',
                'end_time'   => '15:30:00',
            ],
            [
                'name'       => 'Shift 2',
                'start_time' => '14:30:00',
                'end_time'   => '20:30:00',
            ],
        ]);
    }
}
