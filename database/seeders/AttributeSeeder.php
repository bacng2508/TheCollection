<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attributes')->insert(
            [
                [
                    'name' => 'Xuất sứ',
                    'slug' => Str::slug('Xuất sứ')
                ],
                [
                    'name' => 'Bảo hành',
                    'slug' => Str::slug('Bảo hành')
                ],
                [
                    'name' => 'Máy',
                    'slug' => Str::slug('Máy')
                ],
                [
                    'name' => 'Kính',
                    'slug' => Str::slug('Kính')
                ],
                [
                    'name' => 'Đường kính mặt số',
                    'slug' => Str::slug('Đường kính mặt số')
                ],
                [
                    'name' => 'Bề dày mặt số',
                    'slug' => Str::slug('Bề dày mặt số')
                ],
                [
                    'name' => 'Dây đeo',
                    'slug' => Str::slug('Dây đeo')
                ],
                [
                    'name' => 'Chống nước',
                    'slug' => Str::slug('Chống nước')
                ]
            ]
        );
    }
}
