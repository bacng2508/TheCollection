<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert(
            [
                [
                    'user_id' => 1,
                    'product_id' => 1,
                    'rating' => 1,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 1,
                    'rating' => 2,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 1,
                    'rating' => 3,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 1,
                    'rating' => 3,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 1,
                    'rating' => 4,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 1,
                    'rating' => 5,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 1,
                    'rating' => 5,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 2,
                    'rating' => 1,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 2,
                    'rating' => 3,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 2,
                    'rating' => 3,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 3,
                    'rating' => 2,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 3,
                    'rating' => 4,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 3,
                    'rating' => 4,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 3,
                    'rating' => 5,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_id' => 4,
                    'rating' => 5,
                    'content' => fake()->paragraph(1),
                    'status' => 1,
                ],
            ]
        );
    }
}
