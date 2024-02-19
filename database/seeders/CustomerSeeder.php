<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customers::create([
            'name'                  => 'Customer 1',
            'date_of_birth'         => now(),
            'place_of_birth'        => 'Jakarta',
            'identity_number'       => '123456789',
            'gender'                => 'Male',
            'occupation'            => 'Programmer',
            'phone_number'          => '123456789',
            'religion'              => 'Islam',
            'email'                 => 'customer1@mai.com',
            'marrital_status'       => 'Single',
            'address'               => 'Jakarta',
            'instagram'             => 'customer1',
            'youtube'               => 'customer1',
            'facebook'              => 'customer1',
            'source_of_information' => 'Instagram',
        ]);

        Customers::create([
            'name'                  => 'Customer 2',
            'date_of_birth'         => now(),
            'place_of_birth'        => 'Jakarta',
            'identity_number'       => '987654321',
            'gender'                => 'Female',
            'occupation'            => 'Designer',
            'phone_number'          => '987654321',
            'religion'              => 'Islam',
            'email'                 => 'customer2@mail.com',
            'marrital_status'       => 'Single',
            'address'               => 'Jakarta',
            'instagram'             => 'customer2',
            'youtube'               => 'customer2',
            'facebook'              => 'customer2',
            'source_of_information' => 'Instagram',
        ]);
    }
}
