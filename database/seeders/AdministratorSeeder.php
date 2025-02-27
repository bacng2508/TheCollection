<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('administrators')->insert(
            [
                [
                    'name' => 'Super admin',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'superadmin@gmail.com',
                    'password' => Hash::make('password'),
                    'tel' => '0968521625',
                ],
                [
                    'name' => 'Admin 01',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'admin01@gmail.com',
                    'password' => Hash::make('password'),
                    'tel' => '0968521625',
                ],
                [
                    'name' => 'Customer service 01',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customerservice01@gmail.com',
                    'password' => Hash::make('password'),
                    'tel' => '0968521625',
                ],
                [
                    'name' => 'Marketing 01',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'marketing01@gmail.com',
                    'password' => Hash::make('password'),
                    'tel' => '0968521625',
                ],
                [
                    'name' => 'Customer service 02',
                    'avatar' => 'upload/administrator/avatar/default-avatar.png',
                    'email' => 'customerservice02@gmail.com',
                    'password' => Hash::make('password'),
                    'tel' => '0968521625',
                ],
            ]
        );
    }
}
