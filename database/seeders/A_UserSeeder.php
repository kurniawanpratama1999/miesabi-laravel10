<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class A_UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $datas = [
            [
                'role' => 'admin',
                'name' => 'admin',
                'username' =>'admin',
                'phone' => '083827221096',
                'email' => 'admin@admin.com',
                'password' => Hash::make('adminadmin123'),
            ],
            [
                'name' => 'User1',
                'username' => 'user1',
                'phone' => '083827221096',
                'email' => 'user1@mail.com',
                'password' => Hash::make('user1#123'),
            ],
            [
                'name' => 'User2',
                'username' => 'user2',
                'phone' => '083827221096',
                'email' => 'user2@mail.com',
                'password' => Hash::make('user2#123'),
            ],
            [
                'name' => 'User3',
                'username' => 'user3',
                'phone' => '083827221096',
                'email' => 'user3@mail.com',
                'password' => Hash::make('user3#123'),
            ]
        ];

        foreach ($datas as $data) {
            User::create($data);
        }
    }
}
