<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = new Branch();
        $branch->name = "Beauty Dental Pusat Surabaya";
        $branch->phone_number = "08179666161";
        $branch->address = "Jl. Mayjen Sungkono No.17, Sawunggaling, Kec. Wonokromo, Surabaya, Jawa Timur 60242";
        $branch->save();
    }
}
