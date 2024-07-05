<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert(
            [
                [
                    'name' => 'super-admin',
                    'display_name' => 'Quản trị viên cấp cao'
                ],
                [
                    'name' => 'admin',
                    'display_name' => 'Quản trị viên'
                ],
                [
                    'name' => 'customer-service',
                    'display_name' => 'Chăm sóc khách hàng'
                ],
                [
                    'name' => 'marketing-staff',
                    'display_name' => 'Nhân viên marketing'
                ]
            ]
        );
    }
}
