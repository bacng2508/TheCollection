<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert(
            [
                [
                    'name' => 'Casio',
                    'slug' => 'casio',
                    'logo' => 'upload/brands/brand_casio.jpg'
                ],
                [
                    'name' => 'G-Shock',
                    'slug' => 'g-shock',
                    'logo' => 'upload/brands/brand_gshock.jpg'
                ],
                [
                    'name' => 'Citizen',
                    'slug' => 'citizen',
                    'logo' => 'upload/brands/brand_citizen.jpg'
                ],
                [
                    'name' => 'Orient',
                    'slug' => 'orient',
                    'logo' => 'upload/brands/brand_orient.jpg'
                ],
                [
                    'name' => 'Tissot',
                    'slug' => 'tissot',
                    'logo' => 'upload/brands/brand_tissot.jpg'
                ],
                                [
                    'name' => 'Seiko',
                    'slug' => 'seiko',
                    'logo' => 'upload/brands/brand_seiko.jpg'
                ]
            ]
        );
    }
}
