<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class E_DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Sendiri',
                'price' => 0
            ],
            [
                'name' => 'Diantar',
                'price' => 10000
            ],
        ];
        foreach($datas as $data) {
            DeliveryMethod::create($data);
        }
    }
}
