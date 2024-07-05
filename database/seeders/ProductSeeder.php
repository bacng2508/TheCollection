<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                // Dong ho nam
                [
                    'name' => 'Casio A158WA-1DF',
                    'slug' => Str::slug('Casio A158WA-1DF'),
                    'price' => 990000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 1,
                    'brand_id' => 1,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product01.jpg',
                ],
                [
                    'name' => 'Casio MTP-V001L-1BUDF',
                    'slug' => Str::slug('Casio MTP-V001L-1BUDF'),
                    'price' => 1500000,
                    'price_sale' => 1200000,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 1,
                    'brand_id' => 1,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product02.jpg',
                ],
                [
                    'name' => 'G-shock MTP-VT01L-1BUDF',
                    'slug' => Str::slug('G-shock MTP-VT01L-1BUDF'),
                    'price' => 5600000,
                    'price_sale' => 4900000,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 1,
                    'brand_id' => 2,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product03.jpg',
                ],
                [
                    'name' => 'Citizen NH8353-00H',
                    'slug' => Str::slug('Citizen NH8353-00H'),
                    'price' => 3200000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 1,
                    'brand_id' => 3,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product04.jpg',
                ],
                [
                    'name' => 'Citizen Tsuyosa NJ0154-80H',
                    'slug' => Str::slug('Citizen Tsuyosa NJ0154-80H'),
                    'price' => 3200000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 1,
                    'brand_id' => 3,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product05.jpg',
                ],

                // Dong ho nu
                [
                    'name' => 'Casio LTP-V005D-2B3UDF',
                    'slug' => Str::slug('Casio LTP-V005D-2B3UDF'),
                    'price' => 990000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 2,
                    'brand_id' => 1,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product06.jpg',
                ],
                [
                    'name' => 'Citizen LTP-V007L-7E1UDF',
                    'slug' => Str::slug('Citizen LTP-V007L-7E1UDF'),
                    'price' => 1500000,
                    'price_sale' => 1200000,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 2,
                    'brand_id' => 3,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product07.jpg',
                ],
                [
                    'name' => 'Orient LTP-VT02BL-1AUDF',
                    'slug' => Str::slug('Orient LTP-VT02BL-1AUDF'),
                    'price' => 5600000,
                    'price_sale' => 4900000,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 2,
                    'brand_id' => 4,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product08.jpg',
                ],
                [
                    'name' => 'Citizen EM0493-85P',
                    'slug' => Str::slug('Citizen EM0493-85P'),
                    'price' => 3200000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 2,
                    'brand_id' => 3,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product09.jpg',
                ],
                [
                    'name' => 'Tissot EM0508-12A',
                    'slug' => Str::slug('Tissot EM0508-12A'),
                    'price' => 3200000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 2,
                    'brand_id' => 5,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product10.jpg',
                ],

                // Dong ho unisex
                [
                    'name' => 'Tissot Unisex A159WA-N1DF',
                    'slug' => Str::slug('Tissot Unisex A159WA-N1DF'),
                    'price' => 990000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 3,
                    'brand_id' => 5,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product11.jpg',
                ],
                [
                    'name' => 'G-Shock Unisex A168WER-2ADF',
                    'slug' => Str::slug('G-Shock Unisex A168WER-2ADF'),
                    'price' => 1500000,
                    'price_sale' => 1200000,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 3,
                    'brand_id' => 2,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product12.jpg',
                ],
                [
                    'name' => 'CASIO Unisex A168WG-9WDF',
                    'slug' => Str::slug('CASIO Unisex A168WG-9WDF'),
                    'price' => 5600000,
                    'price_sale' => 4900000,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 3,
                    'brand_id' => 1,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product13.jpg',
                ],
                [
                    'name' => 'Seiko Unisex F-91WM-7ADF',
                    'slug' => Str::slug('Seiko Unisex F-91WM-7ADF'),
                    'price' => 3200000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 3,
                    'brand_id' => 6,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product14.jpg',
                ],
                [
                    'name' => 'Seiko Unisex LA680WA-7DF',
                    'slug' => Str::slug('Seiko Unisex LA680WA-7DF'),
                    'price' => 3200000,
                    'price_sale' => 0,
                    'is_featured' => fake()->randomElement([0, 1]),
                    'description' => fake()->paragraph(10),
                    'category_id' => 3,
                    'brand_id' => 6,
                    'quantity' => fake()->randomNumber(2),
                    'thumbnail' => 'upload/product/thumbnails/product15.jpg',
                ]
            ]
        );
    }
}
