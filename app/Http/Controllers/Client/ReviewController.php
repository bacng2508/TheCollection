<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product) {
        $request->validate(
            [
                'rating' => 'required',
                'content' => 'required',
            ],
            [
                'rating.required' => 'Phải lựa chọn rating',
                'content.required' => 'Không được để trống nội dung đánh giá',
            ]
        );

        Review::create([
            'product_id' =>  $product->id,
            'user_id' => Auth::user()->id,
            'rating' => $request->input('rating'),
            'content' => $request->input('content'),
        ]);

        return back();
    }
}
