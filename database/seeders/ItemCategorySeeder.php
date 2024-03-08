<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Semua Kategori'],
            ['name' => 'Alat Kesehatan'],
            ['name' => 'Bahan Laboratorium'],
            ['name' => 'Bahan Tambal'],
            ['name' => 'Bahan Gigi'],
            ['name' => 'Bahan Protesa'],
            ['name' => 'Bahan Ortodonsi'],
            ['name' => 'Bahan Konservasi'],
            ['name' => 'Bahan Pencetakan'],
            ['name' => 'Bahan Pencetakan 3D'],
            ['name' => 'Bahan Pencetakan 3D Ortho'],
            ['name' => 'Bahan Pencetakan 3D Prosthetic'],
        ];

        ItemCategory::insert($categories);
    }
}
