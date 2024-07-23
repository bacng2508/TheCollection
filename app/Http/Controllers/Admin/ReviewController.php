<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-review');
        $productIds = [];
        if ($request->has('search')) {
            $productIds = Product::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id');
        }

        if (count($productIds) > 0) {
            $reviews = Review::whereIn('product_id', $productIds);
            if ($request->rating != '0') {
                $reviews = $reviews->where('rating', $request->rating)->with('user')->latest()->paginate(10)->withQueryString();
            } else {
                $reviews = $reviews->with('user')->paginate(10)->withQueryString();
            }
        } else {
            if ($request->has('rating') && $request->rating != '0') {
                $reviews = Review::where('rating', $request->rating)->with('user')->latest()->paginate(10)->withQueryString();
            } else {
                $reviews = Review::with('user')->paginate(10)->withQueryString();
            }
        }

        return view('admin.reviews.index', compact('reviews'));
    }

    public function changeReviewStatus(Review $review, Request $request) {
        $this->authorize('status-review');
        $review->update([
            'status' => $request->status == 1 ? 0 : 1,
        ]);

        return back()->with('msg', 'Thay đổi trạng thái đánh giá thành công');
    }
}
