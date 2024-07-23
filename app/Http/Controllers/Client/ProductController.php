<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $productAttributeOptions = ProductAttribute::where('product_id',$product->id)->get();
        $reviews = Review::where('product_id', $product->id)->where('status', 1)->with('user')->latest()->get();
        $relateProducts = Product::where('category_id',$product->category_id)->where('id', '<>', $product->id)->get();

        $wasBoughtByUser = false;

        if (Auth::check()) {
            $userOrders = Order::where('user_id', Auth::user()->id)->get();
            foreach($userOrders as $userOrder) {
                $userOrderItems = $userOrder->orderItems;
    
                if ($userOrderItems->contains('product_id', $product->id)) {
                    $wasBoughtByUser = true;
                }
            }
        }
        
        return view('client.detail', compact('product', 'productAttributeOptions', 'reviews', 'relateProducts', 'wasBoughtByUser'));
    }
}
