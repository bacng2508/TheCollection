<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $fillable = ['name', 'value', 'expire_date'];

    public function scopeSearchCoupon($query, $request)
    {
        if ($request->has('q')) {
            $query->where('name', 'LIKE', '%' . $request->q . '%');
        }

        return $query;
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
