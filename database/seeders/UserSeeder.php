<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminPusat = User::create([
            'name' => 'Admin Pusat',
            'email' => 'adminpusat@mail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ]);

        $adminCabang = User::create([
            'name' => 'Admin Cabang',
            'email' => 'admincabang@mail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ]);

        $frontOffice = User::create([
            'name' => 'Front Office',
            'email' => 'frontoffice@mail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ]);

        $adminPusat->assignRole(User::ADMIN_PUSAT_ROLE);
        $adminCabang->assignRole(User::ADMIN_CABANG_ROLE);
        $frontOffice->assignRole(User::FRONT_OFFICE_ROLE);
    }
}
