<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'price', 'sale_price', 'description', 'brand_id', 'category_id', 'quantity', 'thumbnail', 'is_featured'];


    public function scopeSearchProduct($query, $request) {
        if ($request->has('q') && $request->q != null) {
            $query->where('name', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->has('category_id') && $request->category_id != null) {
            $query->where('category_id', $request->category_id);
        }

        return $query;
    }

    public function scopeName($query, $request)
    {
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        return $query;
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('search')) {
            $query->where('name', 'like', "%$request->search%");
        }

        return $query;
    }

    public function scopeCategory($query, $request)
    {
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return $query;
    }

    public function scopeCategoryFilter($query, $categoryId)
    {
        $query->where('category_id', $categoryId);

        return $query;
    }

    public function scopeBrandsFilter($query, $request) {
        if ($request->has('brands')) {
            foreach ($request->brands as $key => $checkedBrandId) {
                if ($key == 0) {
                    $query->where('brand_id', $checkedBrandId);
                } else {
                    $query->orWhere('brand_id', $checkedBrandId);
                }
                
            }
        }
        return $query;
    }
    
    public function scopeProductFilter($query, $request) {
        if ($request->has('categories')) {
            foreach ($request->categories as $checkedCategory) {
                $query->orWhere('category_id', $checkedCategory->id);
            }
        }

        if ($request->has('brands')) {
            foreach ($request->brands as $checkedBrand) {
                $query->orWhere('brand_id', $checkedBrand->id);
            }
        }

        return $query;

        // if ($request->has('attribute_options')) {
        //     foreach ($request->attribute_options as $checkedAttributeOption) {
        //         $query->orWhere('brand_id', $checkedBrand->id);
        //     }
        // }

    }


    public function productAttributes() {
        return $this->hasMany(ProductAttribute::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
