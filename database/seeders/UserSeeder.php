<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Customer 01',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer01@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-02-08 17:30:06'
                    
                ],
                [
                    'name' => 'Customer 02',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer02@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-02-08 17:30:06'
                ],
                [
                    'name' => 'Customer 03',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer03@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-03-08 17:30:06'
                ],
                [
                    'name' => 'Customer 04',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer04@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-03-10 17:30:06'
                ],
                [
                    'name' => 'Customer 05',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer05@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-04-12 17:30:06'
                ],
                [
                    'name' => 'Customer 06',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer06@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-04-12 17:30:06'
                ],
                [
                    'name' => 'Customer 07',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer07@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-05-10 17:30:06'
                ],
                [
                    'name' => 'Customer 08',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer08@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-05-12 17:30:06'
                ],
                [
                    'name' => 'Customer 09',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer09@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-06-02 17:30:06'
                ],
                [
                    'name' => 'Customer 10',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer10@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-06-03 17:30:06'
                ],
                [
                    'name' => 'Customer 11',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer11@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-06-04 17:30:06'
                ],
                [
                    'name' => 'Customer 12',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer12@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-06-20 17:30:06'
                ],
                [
                    'name' => 'Customer 13',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer13@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-06-20 18:30:06'
                ],
                [
                    'name' => 'Customer 14',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer14@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-06-22 18:30:06'
                ],
                [
                    'name' => 'Customer 15',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customer15@gmail.com',
                    'password' => Hash::make('12345678'),
                    'tel' => '09867246528',
                    'status' => 1,
                    'created_at' => '2024-06-25 18:30:06'
                ],
                
            ]
        );
    }
}
