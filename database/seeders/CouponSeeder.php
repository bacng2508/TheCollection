<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert(
            [
                [
                    'name' => 'KHAITRUONG01',
                    'value' => '15',
                    'expire_date' => new Carbon('2024-07-15 00:00:00')
                ],
                [
                    'name' => 'SUMMER24',
                    'value' => '10',
                    'expire_date' => new Carbon('2024-07-30 00:00:00')
                ]
            ]
        );
    }
}
