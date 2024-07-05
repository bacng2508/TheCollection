<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = ['user_id', 'product_id', 'name', 'thumbnail', 'price', 'price_sale', 'quantity'];

    public function product() {
        return $this->hasOne(Product::class);
    }
}
