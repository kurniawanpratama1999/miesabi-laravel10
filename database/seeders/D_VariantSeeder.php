<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class D_VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Original',
                'product_id' => 1,
                'price' => 0
            ],
            [
                'name' => 'Yamin',
                'product_id' => 1,
                'price' => 0
            ],
            [
                'name' => 'Chili Oil',
                'product_id' => 1,
                'price' => 0
            ],
            [
                'name' => 'Sapi',
                'product_id' => 2,
                'price' => 0
            ],
            [
                'name' => 'Ayam',
                'product_id' => 2,
                'price' => 0
            ],
            [
                'name' => 'Panas',
                'product_id' => 3,
                'price' => 0
            ],
            [
                'name' => 'Dingin',
                'product_id' => 3,
                'price' => 0
            ],
        ];

        foreach($datas as $data) {
            Variant::create($data);
        }
    }
}
