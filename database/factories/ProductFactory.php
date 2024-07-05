<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Brand;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $slug = Str::slug($name);
        
        return [
            'name' => $name,
            'slug' => $slug,
            'price' => fake()->randomNumber(4),
            'description' => fake()->sentence(6) ,
            'category_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'quantity' => fake()->randomNumber(2),
            'thumbnail' => fake()->image(storage_path('app/public/upload/product'), 50, 50),
        ];
    }
}
