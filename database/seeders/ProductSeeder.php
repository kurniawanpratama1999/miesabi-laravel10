<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'category_id' => 1,
                'code' => 'MIE-0001',
                'name' => 'Mie Ayam',
                'price' => 12000,
                'stock' => 20,
            ],
            [
                'category_id' => 1,
                'code' => 'BKS-0001',
                'name' => 'Bakso',
                'price' => 10000,
                'stock' => 20,
            ],
            [
                'category_id' => 2,
                'code' => 'TEH-0001',
                'name' => 'Teh Manis',
                'price' => 5000,
                'stock' => 20,
            ],
            [
                'category_id' => 2,
                'code' => 'KOP-0001',
                'name' => 'Kopi Hitam',
                'price' => 5000,
                'stock' => 20,
            ],
            [
                'category_id' => 2,
                'code' => 'AIR-0001',
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
