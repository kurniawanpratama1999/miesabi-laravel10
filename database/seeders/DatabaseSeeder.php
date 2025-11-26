<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            A_UserSeeder::class,
            B_CategorySeeder::class,
            C_ProductSeeder::class,
            D_VariantSeeder::class,
            E_DeliverySeeder::class,
        ]);
    }
}
