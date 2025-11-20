<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class F_OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'user_id' => 2,
                'product_id' => 1,
                'variant_id' => 1,
                'merge' => '1-1',
                'quantity' => 1,
            ],
            [
                'user_id' => 2,
                'product_id' => 1,
                'variant_id' => 2,
                'merge' => '1-2',
                'quantity' => 1,
            ],
            [
                'user_id' => 2,
                'product_id' => 3,
                'variant_id' => 1,
                'merge' => '3-1',
                'quantity' => 2,
            ],
            [
                'user_id' => 2,
                'product_id' => 4,
                'variant_id' => 2,
                'merge' => '4-2',
                'quantity' => 1,
            ],
            [
                'user_id' => 2,
                'product_id' => 4,
                'variant_id' => 2,
                'merge' => '4-2',
                'quantity' => 1,
            ],
        ];

        foreach ($datas as $data) {
            Order::create($data);
        }
    }
}
