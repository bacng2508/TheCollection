<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;

use App\Models\Product;

class CartController extends Controller
{
    public function index() {
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        $cartTotalMoney = 0;
        foreach ($cartItems as $item) {
            $cartTotalMoney+= ($item->price_sale != 0 ? $item->price_sale : $item->price)*$item->quantity;
        }
        return view('client.cart', compact('cartItems', 'cartTotalMoney'));
    }

    public function isCartAllow() {
        return Auth::check();
    }

    public function store(Request $request) {
        $productCart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
        if ($productCart) {
            $productCart->update(['quantity' => $productCart->quantity + $request->quantity]);
        } else {
            $product = Product::findOrFail($request->id);
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'name' => $product->name,
                'thumbnail' => $product->thumbnail,
                'price' => $product->price,
                'price_sale' => $product->price_sale,
                'quantity' => $request->quantity
            ]);   
        }

        return response()->json([
            "cartItems" => Cart::where('user_id', Auth::user()->id ?? "")->get() ?? ""
        ]);
    }

    public function destroy(Request $request) {
        $productDelete = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
        $productDelete->delete();
        return Cart::where('user_id', Auth::user()->id)->get();
    }

    public function update(Request $request) {
        $productCart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
        $productCart->update(['quantity' => $request->quantity]);

        return response()->json([
            "cartItems" => Cart::where('user_id', Auth::user()->id ?? "")->get() ?? ""
        ]);
    }
}
