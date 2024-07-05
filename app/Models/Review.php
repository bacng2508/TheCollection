<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = ['product_id', 'user_id', 'rating', 'content', 'status'];

    public function scopeProductNameFilter($query, $request)
    {
        if ($request->has('product_name')) {
            $query->where('product_name', 'LIKE', '%' . $request->name . '%');
        }

        return $query;
    }

    public function scopeRatingFilter($query, $request)
    {
        if ($request->has('rating')) {
            $query->where('rating', $request->rating);
        }

        return $query;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
