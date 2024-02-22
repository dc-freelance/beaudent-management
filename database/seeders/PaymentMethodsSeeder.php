<?php

namespace Database\Seeders;

use App\Models\PaymentMethods;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethod = [
            [
                'name'  => 'Cash',
            ],
            [
                'name'  => 'Transfer',
            ],
            [
                'name'  => 'Debit',
            ],
        ];

        PaymentMethods::insert($paymentMethod);
    }
}
