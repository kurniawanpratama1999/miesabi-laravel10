<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class B_CategorySeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => "makanan"
            ],
            [
                'name' => "minuman"
            ],
        ];

        foreach($datas as $data) {
            Category::create($data);
        }
    }
}
