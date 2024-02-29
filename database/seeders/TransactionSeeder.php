<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaction = [
            [
                'code' => '(Dummy)BEU-INV-CBG-1-24-02-001',
                'branch_id' => 2,
                'date_time' => now(),
                'doctor_id' => 1,
                'customer_id' => 1,
                'note' => 'Catatan Transaksi',
                'is_paid' => 0,
                'payment_method_id' => 1,
                'cashier_id' => 1,
                'ppn_status' => 'Include',
                'total' => 1000000,
                'discount' => 0,
                'total_ppn' => 0,
                'grand_total' => 1000000,
                'created_at' => now(),
                'updated_at' => now(),
                'examination_id' => 1
            ],
            [
                'code' => '(Dummy)BEU-INV-CBG-1-24-02-002',
                'branch_id' => 2,
                'date_time' => now(),
                'doctor_id' => 1,
                'customer_id' => 2,
                'note' => 'Catatan Transaksi',
                'is_paid' => 1,
                'payment_method_id' => 1,
                'cashier_id' => 1,
                'ppn_status' => 'Include',
                'total' => 2000000,
                'discount' => 0,
                'total_ppn' => 0,
                'grand_total' => 2000000,
                'created_at' => now(),
                'updated_at' => now(),
                'examination_id' => 2
            ],
            [
                'code' => '(Dummy)BEU-INV-CBG-1-24-02-002',
                'branch_id' => 3,
                'date_time' => now(),
                'doctor_id' => 1,
                'customer_id' => 1,
                'note' => 'Catatan Transaksi',
                'is_paid' => 1,
                'payment_method_id' => 1,
                'cashier_id' => 1,
                'ppn_status' => 'Include',
                'total' => 2000000,
                'discount' => 0,
                'total_ppn' => 0,
                'grand_total' => 2000000,
                'created_at' => now(),
                'updated_at' => now(),
                'examination_id' => 3
            ]
        ];

        Transaction::insert($transaction);
    }
}
