<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // User
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // Role
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'read role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        // Permission
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'read permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        // Branch
        Permission::create(['name' => 'create branch']);
        Permission::create(['name' => 'read branch']);
        Permission::create(['name' => 'update branch']);
        Permission::create(['name' => 'delete branch']);

        // Product
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'read product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);

        // Doctor Category
        Permission::create(['name' => 'create doctor category']);
        Permission::create(['name' =>'read doctor category']);
        Permission::create(['name' => 'update doctor category']);
        Permission::create(['name' => 'delete doctor category']);

        // Doctor
        Permission::create(['name' => 'create doctor']);
        Permission::create(['name' =>'read doctor']);
        Permission::create(['name' => 'update doctor']);
        Permission::create(['name' => 'delete doctor']);

        // Doctor Schedule
        Permission::create(['name' => 'create doctor schedule']);
        Permission::create(['name' =>'read doctor schedule']);
        Permission::create(['name' => 'update doctor schedule']);
        Permission::create(['name' => 'delete doctor schedule']);

        // Treatment
        Permission::create(['name' => 'create treatment']);
        Permission::create(['name' =>'read treatment']);
        Permission::create(['name' => 'update treatment']);
        Permission::create(['name' => 'delete treatment']);

        // Treatment Category
        Permission::create(['name' => 'create treatment category']);
        Permission::create(['name' =>'read treatment category']);
        Permission::create(['name' => 'update treatment category']);
        Permission::create(['name' => 'delete treatment category']);

        // Treatment Bonus
        Permission::create(['name' => 'create treatment bonus']);
        Permission::create(['name' =>'read treatment bonus']);
        Permission::create(['name' => 'update treatment bonus']);
        Permission::create(['name' => 'delete treatment bonus']);
    
        // Discount
        Permission::create(['name' => 'create discount']);
        Permission::create(['name' =>'read discount']);
        Permission::create(['name' => 'update discount']);
        Permission::create(['name' => 'delete discount']);
    
        // Addon
        Permission::create(['name' => 'create addon']);
        Permission::create(['name' =>'read addon']);
        Permission::create(['name' => 'update addon']);
        Permission::create(['name' => 'delete addon']);

        // Customer
        Permission::create(['name' => 'create customer']);
        Permission::create(['name' =>'read customer']);
        Permission::create(['name' => 'detail customer']);
        Permission::create(['name' => 'update customer']);
        Permission::create(['name' => 'delete customer']);

        // Item
        Permission::create(['name' => 'create item']);
        Permission::create(['name' =>'read item']);
        Permission::create(['name' => 'update item']);
        Permission::create(['name' => 'delete item']);

        // Item Category
        Permission::create(['name' => 'create item category']);
        Permission::create(['name' =>'read item category']);
        Permission::create(['name' => 'update item category']);
        Permission::create(['name' => 'delete item category']);
    
        // Item Unit
        Permission::create(['name' => 'create item unit']);
        Permission::create(['name' =>'read item unit']);
        Permission::create(['name' => 'update item unit']);
        Permission::create(['name' => 'delete item unit']);
    
        // Supplier
        Permission::create(['name' => 'create supplier']);
        Permission::create(['name' =>'read supplier']);
        Permission::create(['name' => 'update supplier']);
        Permission::create(['name' => 'delete supplier']);

        // Config Shift
        Permission::create(['name' => 'create config shift']);
        Permission::create(['name' =>'read config shift']);
        Permission::create(['name' => 'update config shift']);
        Permission::create(['name' => 'delete config shift']);
    
        // Payment Method
        Permission::create(['name' => 'create payment method']);
        Permission::create(['name' =>'read payment method']);
        Permission::create(['name' => 'update payment method']);
        Permission::create(['name' => 'delete payment method']);

        // Reservation
        Permission::create(['name' =>'read wait reservation']);
        Permission::create(['name' => 'read confirm reservation']);
        Permission::create(['name' => 'read done reservation']);
        Permission::create(['name' => 'read cancel reservation']);
        Permission::create(['name' => 'reschedule reservation']);
        Permission::create(['name' => 'detail reservation']);
        Permission::create(['name' => 'delete reservation']);

        // Deposit
        Permission::create(['name' =>'read wait deposit']);
        Permission::create(['name' =>'read confirm deposit']);
        Permission::create(['name' => 'reschedule deposit']);
        Permission::create(['name' =>'detail deposit']);
        Permission::create(['name' => 'delete deposit']);

        // Shift Log
        Permission::create(['name' =>'read shift log']);
        Permission::create(['name' => 'print shift log']);
    }
}
