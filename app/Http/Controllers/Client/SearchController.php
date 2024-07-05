<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Support\Facades\URL;

class SearchController extends Controller
{
    public function index() {

    }

    public function search(Request $request) {
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        $attributeOptions = AttributeOption::all();
        $q = $request->q;
        $cat = $request->cat;

        if ($request->sortBy == null) {
            $sortBy = ["price", "asc"];
        } else {
            $sortBy = explode('-', $request->sortBy);
        }


        if ($request->cat == '0') {
            $searchResult = Product::where('name', 'LIKE', '%' . $request->q . '%')
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
        } else {
            $searchResult = Product::where('name', 'LIKE', '%' . $request->cat . '%')
            ->where('category_id', $request->cat)
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
            ->sortBy([[$sortBy[0], $sortBy[1]]])
            ->paginate(9)
            ->withQueryString();
        }

        return view('client.search', compact(['q', 'cat', 'categories', 'brands', 'attributes', 'attributeOptions', 'searchResult']));
    }

    

    public function liveSearch(Request $request) {

        if ($request->searchCategory == '0') {
            $searchResult = Product::where('name', 'LIKE', '%' . $request->searchKey . '%')
            ->take(5)
            ->get()
            ->toArray();
        } else {
            $searchResult = Product::where('category_id', $request->searchCategory)
            ->where('name', 'LIKE', '%' . $request->searchKey . '%')
            ->take(5)
            ->get()->toArray();
        }

        return response()->json($searchResult);
    }
}
