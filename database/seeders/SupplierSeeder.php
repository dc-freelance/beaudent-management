<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name'         => 'PT. ABC',
                'phone_number' => '081234567890',
                'address'      => 'Jl. ABC No. 123',
                'debt'         => 50000000,
            ],
            [
                'name'         => 'PT. DEF',
                'phone_number' => '081234567891',
                'address'      => 'Jl. DEF No. 123',
                'debt'         => 50000000,
            ],
            [
                'name'         => 'PT. GHI',
                'phone_number' => '081234567892',
                'address'      => 'Jl. GHI No. 123',
                'debt'         => 50000000,
            ],
            [
                'name'         => 'PT. JKL',
                'phone_number' => '081234567893',
                'address'      => 'Jl. JKL No. 123',
                'debt'         => 50000000,
            ],
            [
                'name'         => 'PT. MNO',
                'phone_number' => '081234567894',
                'address'      => 'Jl. MNO No. 123',
                'debt'         => 50000000,
            ],
            [
                'name'         => 'PT. PQR',
                'phone_number' => '081234567895',
                'address'      => 'Jl. PQR No. 123',
                'debt'         => 50000000,
            ],
            [
                'name'         => 'PT. STU',
                'phone_number' => '081234567896',
                'address'      => 'Jl. STU No. 123',
                'debt'         => 2500000,
            ],
            [
                'name'         => 'PT. VWX',
                'phone_number' => '081234567897',
                'address'      => 'Jl. VWX No. 123',
                'debt'         => 2500000,
            ],
            [
                'name'         => 'PT. YZA',
                'phone_number' => '081234567898',
                'address'      => 'Jl. YZA No. 123',
                'debt'         => 2500000,
            ],
            [
                'name'         => 'PT. BCD',
                'phone_number' => '081234567899',
                'address'      => 'Jl. BCD No',
                'debt'         => 2500000,
            ],
        ];

        Supplier::insert($suppliers);
    }
}
