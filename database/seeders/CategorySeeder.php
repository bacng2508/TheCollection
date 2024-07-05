<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                [
                    'name' => 'Đồng hồ nam',
                    'slug' => 'dong-ho-nam'
                ],
                [
                    'name' => 'Đồng hồ nữ',
                    'slug' => 'dong-ho-nu'
                ],
                [
                    'name' => 'Đồng hồ unisex',
                    'slug' => 'dong-ho-unisex'
                ],
            ]
        );
    }
}
