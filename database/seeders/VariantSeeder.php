<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'product_id' => 1,
                'variant_name' => 'Original',
            ],
            [
                'product_id' => 1,
                'variant_name' => 'Yamin',
            ],
            [
                'product_id' => 1,
                'variant_name' => 'Chili Oil',
            ],
            [
                'product_id' => 2,
                'variant_name' => 'Sapi',
            ],
            [
                'product_id' => 2,
                'variant_name' => 'Ayam',
            ],
            [
                'product_id' => 3,
                'variant_name' => 'Panas',
            ],
            [
                'product_id' => 3,
                'variant_name' => 'Dingin',
            ],
        ];

        foreach($datas as $data) {
            Variant::create($data);
        }
    }
}
