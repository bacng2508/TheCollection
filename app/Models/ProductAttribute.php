<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';
    protected $fillable = ['product_id', 'attribute_option_id'];

    public function scopeAttributeOptionFilter($query, $request)
    {
        $attributes = Attribute::all();

        foreach ($attributes as $attribute) {
            if ($request->has($attribute->slug)) {
                foreach($request[$attribute->slug] as $item) {
                    $query->orWhere('attribute_option_id', $item);
                }
            }
        }

        return $query;
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function attributeOption() {
        return $this->belongsTo(AttributeOption::class);
    }
}
