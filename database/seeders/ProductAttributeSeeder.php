<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = Attribute::all();
        $products = Product::all();

        foreach ($products as $product) {
            foreach ($attributes as $attribute) {
                DB::table('product_attributes')->insert(
                [
                    [
                        'product_id' => $product->id,
                        'attribute_option_id' => AttributeOption::where('attribute_id', $attribute->id)->get()->random()->id,
                    ]
                ]
        );
            }
        }
    }
}
