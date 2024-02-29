<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // $roles = [
        //     User::ADMIN_PUSAT_ROLE,
        //     User::ADMIN_CABANG_ROLE,
        //     User::FRONT_OFFICE_ROLE,
        //     User::MANAGER_CABANG_ROLE,
        //     User::BILLING_ROLE,
        //     User::OWNER_ROLE,
        // ];
        // Role::insert(array_map(fn ($role) => ['name' => $role, 'guard_name' => 'web'], $roles));
 
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        $role_admin_pusat = Role::create(['name' => User::ADMIN_PUSAT_ROLE, 'guard_name' => 'web']);
        $role_admin_cabang = Role::create(['name' => User::ADMIN_CABANG_ROLE, 'guard_name' => 'web']);
        $role_front_office = Role::create(['name' => User::FRONT_OFFICE_ROLE, 'guard_name' => 'web']);
        $role_manager_cabang = Role::create(['name' => User::MANAGER_CABANG_ROLE, 'guard_name' => 'web']);
        $role_billing = Role::create(['name' => User::BILLING_ROLE, 'guard_name' => 'web']);
        $role_owner = Role::create(['name' => User::OWNER_ROLE, 'guard_name' => 'web']);
        $role_telemarketing = Role::create(['name' => User::TELEMARKETING_ROLE, 'guard_name' => 'web']);


        $permission_admin_pusat = [
            // Menu Manajemen Pengguna
            'read_permission', 'update_permission', 'delete_permission', 'create_permission',
            'read_role', 'update_role', 'delete_role', 'create_role',
            'read_user', 'update_user', 'delete_user', 'create_user',

            // Menu Manajemen Dokter
            'create_doctor_category', 'update_doctor_category', 'delete_doctor_category', 'read_doctor_category',
            'create_doctor', 'update_doctor', 'delete_doctor', 'read_doctor',

            // Menu Manajemen Layanan
            'create_treatment_category', 'update_treatment_category', 'delete_treatment_category', 'delete_treatment_category',
            'create_treatment', 'update_treatment', 'delete_treatment', 'read_treatment',
            'create_treatment_bonus', 'update_treatment_bonus', 'delete_treatment_bonus', 'read_treatment_bonus',
            'create_addon', 'update_addon', 'delete_addon', 'read_addon',

            // Menu Manajemen Diskon
            'create_discount', 'update_discount', 'delete_discount', 'read_discount',
            'create_discount_treatment', 'update_discount_treatment', 'delete_discount_treatment', 'read_discount_treatment',
            'create_discount_item', 'update_discount_item', 'delete_discount_item', 'read_discount_item',

            // Menu Manajemen Cabang
            'create_branch', 'update_branch', 'delete_branch', 'read_branch',

            // Menu Manajemen Pasien
            'create_customer', 'update_customer', 'delete_customer', 'read_customer',

            // Menu Manajemen Barang
            'create_item', 'update_item', 'delete_item', 'read_item',
            'create_item_category', 'update_item_category', 'delete_item_category', 'read_item_category',
            'create_item_unit', 'update_item_unit', 'delete_item_unit', 'read_item_unit',

            // Menu Manajemen pemasok
            'create_supplier', 'update_supplier', 'delete_supplier', 'read_supplier',

            // Menu Konfigurasi Shift
            'create_config_shift', 'update_config_shift', 'delete_config_shift', 'read_config_shift',

            // Menu Pembayaran
            'create_payment_method', 'update_payment_method', 'delete_payment_method', 'read_payment_method',

            // Menu Manajemen Reservasi
            'read_wait_reservation', 'read_confirm_reservation', 'read_done_reservation', 'read_cancel_reservation',
            'reschedule_reservation', 'detail_reservation', 'delete_reservation',

            // Deposit
            'read_wait_deposit', 'read_confirm_deposit', 'read_cancel_deposit', 'reschedule_deposit',
            'detail_deposit', 'delete_deposit',

            // Menu Manamjemen Sesi
            'read_open_shift_log', 'read_close_shift_log', 'read_recap_shift_log', 'create_shift_log', 'update_shift_log', 'print_shift_log'
        ];

        $permission_telemarketing = [
            // Menu Manajemen Reservasi
            'read_wait_reservation', 'read_confirm_reservation', 'read_done_reservation', 'read_cancel_reservation',
            'reschedule_reservation', 'detail_reservation', 'delete_reservation',

            // Deposit
            'read_wait_deposit', 'read_confirm_deposit', 'read_cancel_deposit', 'reschedule_deposit',
            'detail_deposit', 'delete_deposit',
        ];

        $permission_front_office = [
            // Menu Manajemen Reservasi
            'read_wait_reservation', 'read_confirm_reservation', 'read_done_reservation', 'read_cancel_reservation',
            'reschedule_reservation', 'detail_reservation', 'delete_reservation',

            // Deposit
            'read_wait_deposit', 'read_confirm_deposit', 'read_cancel_deposit', 'reschedule_deposit',
            'detail_deposit', 'delete_deposit',

            // Menu Manamjemen Sesi
            'read_open_shift_log', 'read_close_shift_log', 'read_recap_shift_log', 'create_shift_log', 'update_shift_log', 'print_shift_log'
        ];

        $role_admin_pusat->givePermissionTo($permission_admin_pusat);
        $role_front_office->givePermissionTo($permission_front_office);
        $role_telemarketing->givePermissionTo($permission_telemarketing);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
