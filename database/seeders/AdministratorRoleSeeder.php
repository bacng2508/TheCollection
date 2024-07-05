<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AdministratorRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('administrator_role')->insert(
            [
                [
                    'administrator_id' => 1,
                    'role_id' => 1,
                ],
                [
                    'administrator_id' => 2,
                    'role_id' => 2,
                ],
                [
                    'administrator_id' => 3,
                    'role_id' => 3,
                ],
                [
                    'administrator_id' => 3,
                    'role_id' => 4,
                ],
                [
                    'administrator_id' => 4,
                    'role_id' => 4,
                ],
                [
                    'administrator_id' => 5,
                    'role_id' => 3,
                ]
            ]
        );
    }
}
