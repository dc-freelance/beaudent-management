<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservations;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brances = [
            [
                'no'                         => 'BEU-RSV-CBG-1-24-02-002',
                'branch_id'                  => 2,
                'request_date'               => now(),
                'request_time'               => now(),
                'anamnesis'                  => 'Tidak Ada Riwayat Penyakit Sebelumnya',
                'customer_id'                => 1,
                'status'                     => 'Pending',
                'deposit'                    => 100000,
                'deposit_receipt'            => 'upload/deposit-receipt-customer1.png',
                'customer_bank_account'      => '123456789',
                'customer_bank'              => 'BCA',
                'customer_bank_account_name' => 'Customer X',
                'transfer_date'              => now(),
                'treatment_id'               => 1,
                'is_control'                 => 0,
                'created_at'                 => now(),
                'updated_at'                 => now(),
            ],
            [
                'no'                         => 'BEU-RSV-CBG-1-24-02-002',
                'branch_id'                  => 2,
                'request_date'               => now(),
                'request_time'               => now(),
                'anamnesis'                  => 'Tidak Ada Riwayat Penyakit Sebelumnya',
                'customer_id'                => 2,
                'status'                     => 'Pending',
                'deposit'                    => 100000,
                'deposit_receipt'            => 'upload/deposit-receipt-customer2.png',
                'customer_bank_account'      => '987654321',
                'customer_bank'              => 'BRI',
                'customer_bank_account_name' => 'Customer XBRI',
                'transfer_date'              => now(),
                'treatment_id'               => 1,
                'is_control'                 => 0,
                'created_at'                 => now(),
                'updated_at'                 => now(),
            ],
            [
                'no'                         => 'BEU-RSV-CBG-1-24-02-002',
                'branch_id'                  => 3,
                'request_date'               => now(),
                'request_time'               => now(),
                'anamnesis'                  => 'Tidak Ada Riwayat Penyakit Sebelumnya',
                'customer_id'                => 2,
                'status'                     => 'Pending',
                'deposit'                    => 100000,
                'deposit_receipt'            => 'upload/deposit-receipt-customer2.png',
                'customer_bank_account'      => '987654321',
                'customer_bank'              => 'BRI',
                'customer_bank_account_name' => 'Customer XBRI',
                'transfer_date'              => now(),
                'treatment_id'               => 1,
                'is_control'                 => 0,
                'created_at'                 => now(),
                'updated_at'                 => now(),
            ],
        ];

        Reservations::insert($brances);
    }
}
