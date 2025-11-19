<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class C_ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'category_id' => 1,
                'name' => 'Mie Ayam',
                'price' => 12000,
                'stock' => 20,
            ],
            [
                'category_id' => 1,
                'name' => 'Bakso',
                'price' => 10000,
                'stock' => 20,
            ],
            [
                'category_id' => 2,
                'name' => 'Teh Manis',
                'price' => 5000,
                'stock' => 20,
            ],
            [
                'category_id' => 2,
                'name' => 'Kopi Hitam',
                'price' => 5000,
                'stock' => 20,
            ],
            [
                'category_id' => 2,
                'name' => 'Air Mineral',
                'price' => 5000,
                'stock' => 20,
            ],
        ];

        foreach($datas as $data) {
            Product::create($data);
        }
    }
}
