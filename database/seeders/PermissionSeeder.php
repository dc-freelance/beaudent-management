<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // User
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'read_user']);
        Permission::create(['name' => 'update_user']);
        Permission::create(['name' => 'delete_user']);

        // Role
        Permission::create(['name' => 'create_role']);
        Permission::create(['name' => 'read_role']);
        Permission::create(['name' => 'update_role']);
        Permission::create(['name' => 'delete_role']);

        // Permission
        Permission::create(['name' => 'create_permission']);
        Permission::create(['name' => 'read_permission']);
        Permission::create(['name' => 'update_permission']);
        Permission::create(['name' => 'delete_permission']);

        // Branch
        Permission::create(['name' => 'create_branch']);
        Permission::create(['name' => 'read_branch']);
        Permission::create(['name' => 'update_branch']);
        Permission::create(['name' => 'delete_branch']);

        // Product
        Permission::create(['name' => 'create_product']);
        Permission::create(['name' => 'read_product']);
        Permission::create(['name' => 'update_product']);
        Permission::create(['name' => 'delete_product']);

        // Doctor Category
        Permission::create(['name' => 'create_doctor_category']);
        Permission::create(['name' =>'read_doctor_category']);
        Permission::create(['name' => 'update_doctor_category']);
        Permission::create(['name' => 'delete_doctor_category']);

        // Doctor
        Permission::create(['name' => 'create_doctor']);
        Permission::create(['name' =>'read_doctor']);
        Permission::create(['name' => 'update_doctor']);
        Permission::create(['name' => 'delete_doctor']);

        // Doctor Schedule
        Permission::create(['name' => 'create_doctor_schedule']);
        Permission::create(['name' =>'read_doctor_schedule']);
        Permission::create(['name' => 'update_doctor_schedule']);
        Permission::create(['name' => 'delete_doctor_schedule']);

        // Treatment
        Permission::create(['name' => 'create_treatment']);
        Permission::create(['name' =>'read_treatment']);
        Permission::create(['name' => 'update_treatment']);
        Permission::create(['name' => 'delete_treatment']);

        // Treatment Category
        Permission::create(['name' => 'create_treatment_category']);
        Permission::create(['name' =>'read_treatment_category']);
        Permission::create(['name' => 'update_treatment_category']);
        Permission::create(['name' => 'delete_treatment_category']);

        // Treatment Bonus
        Permission::create(['name' => 'create_treatment_bonus']);
        Permission::create(['name' =>'read_treatment_bonus']);
        Permission::create(['name' => 'update_treatment_bonus']);
        Permission::create(['name' => 'delete_treatment_bonus']);
    
        // Discount
        Permission::create(['name' => 'create_discount']);
        Permission::create(['name' =>'read_discount']);
        Permission::create(['name' => 'update_discount']);
        Permission::create(['name' => 'delete_discount']);
    
        // Addon
        Permission::create(['name' => 'create_addon']);
        Permission::create(['name' =>'read_addon']);
        Permission::create(['name' => 'update_addon']);
        Permission::create(['name' => 'delete_addon']);

        // Customer
        Permission::create(['name' => 'create_customer']);
        Permission::create(['name' =>'read_customer']);
        Permission::create(['name' => 'detail_customer']);
        Permission::create(['name' => 'update_customer']);
        Permission::create(['name' => 'delete_customer']);

        // Item
        Permission::create(['name' => 'create_item']);
        Permission::create(['name' =>'read_item']);
        Permission::create(['name' => 'update_item']);
        Permission::create(['name' => 'delete_item']);

        // Item Category
        Permission::create(['name' => 'create_item_category']);
        Permission::create(['name' =>'read_item_category']);
        Permission::create(['name' => 'update_item_category']);
        Permission::create(['name' => 'delete_item_category']);
    
        // Item Unit
        Permission::create(['name' => 'create_item_unit']);
        Permission::create(['name' =>'read_item_unit']);
        Permission::create(['name' => 'update_item_unit']);
        Permission::create(['name' => 'delete_item_unit']);
    
        // Supplier
        Permission::create(['name' => 'create_supplier']);
        Permission::create(['name' =>'read_supplier']);
        Permission::create(['name' => 'update_supplier']);
        Permission::create(['name' => 'delete_supplier']);

        // Config Shift
        Permission::create(['name' => 'create_config_shift']);
        Permission::create(['name' =>'read_config_shift']);
        Permission::create(['name' => 'update_config_shift']);
        Permission::create(['name' => 'delete_config_shift']);
    
        // Payment Method
        Permission::create(['name' => 'create_payment_method']);
        Permission::create(['name' =>'read_payment_method']);
        Permission::create(['name' => 'update_payment_method']);
        Permission::create(['name' => 'delete_payment_method']);

        // Reservation
        Permission::create(['name' =>'read_wait_reservation']);
        Permission::create(['name' => 'read_confirm_reservation']);
        Permission::create(['name' => 'read_done_reservation']);
        Permission::create(['name' => 'read_cancel_reservation']);
        Permission::create(['name' => 'reschedule_reservation']);
        Permission::create(['name' => 'detail_reservation']);
        Permission::create(['name' => 'delete_reservation']);

        // Deposit
        Permission::create(['name' =>'read_wait_deposit']);
        Permission::create(['name' =>'read_confirm_deposit']);
        Permission::create(['name' =>'read_cancel_deposit']);
        Permission::create(['name' =>'reschedule_deposit']);
        Permission::create(['name' =>'detail_deposit']);
        Permission::create(['name' =>'delete_deposit']);

        // Shift Log
        Permission::create(['name' =>'read_open_shift_log']);
        Permission::create(['name' =>'read_close_shift_log']);
        Permission::create(['name' =>'read_recap_shift_log']);
        Permission::create(['name' =>'create_shift_log']);
        Permission::create(['name' =>'update_shift_log']);
        Permission::create(['name' => 'print_shift_log']);

        // Discount Treatment
        Permission::create(['name' => 'create_discount_treatment']);
        Permission::create(['name' =>'read_discount_treatment']);
        Permission::create(['name' => 'update_discount_treatment']);
        Permission::create(['name' => 'delete_discount_treatment']);

        // Discount Item
        Permission::create(['name' => 'create_discount_item']);
        Permission::create(['name' =>'read_discount_item']);
        Permission::create(['name' => 'update_discount_item']);
        Permission::create(['name' => 'delete_discount_item']);
    }
}
