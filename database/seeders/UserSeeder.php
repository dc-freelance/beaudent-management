<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin BeauDent',
            'email' => 'admin@mail.com',
            'phone_number' => '082345678910',
            'join_date' => '2000-12-30',
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
            'branch_id' => 1,
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($admin));
        $admin->assignRole('admin');
    }
}
