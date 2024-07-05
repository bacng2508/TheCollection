<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Brand;
use App\Models\ProductAttribute;

class CategoryController extends Controller
{
    public function index(Category $category, Request $request) {
        $categoryShow = $category;
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        $attributeOptions = AttributeOption::all();

        if ($request->sortBy == null) {
            $sortBy = ["price", "asc"];
        } else {
            $sortBy = explode('-', $request->sortBy);
        }

        $products = Product::query()
            ->categoryFilter($category->id)
            ->brandsFilter($request)
            ->get()
            ->filter(function(Product $product) use ($request) {
                $productAttributes = $product->productAttributes;

                if ($request->has('attribute_options')) {
                    $flag = false;
                    foreach ($request->attribute_options as $checkedAttributeOption) {
                        if ($productAttributes->contains('attribute_option_id', $checkedAttributeOption)) {
                            $flag = true;
                        }
                    }

                    return $flag;
                }

                return true;
            })
            ->sortBy([$sortBy])
            ->paginate(9)
            ->withQueryString();

        return view('client.category', compact('categoryShow' ,'products', 'categories', 'brands', 'attributes', 'attributeOptions'));
    }
}
