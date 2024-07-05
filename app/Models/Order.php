<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'order_code',
        'user_id', 
        'fullname', 
        'email', 
        'phone_number', 
        'address', 
        'note', 
        'coupon_id', 
        'discount', 
        'sub_total', 
        'grand_total', 
        'payment_method', 
        'order_date',
        'order_status'
    ];

    public function scopeFilterOrder($query, $request) {
        if ($request->has('order_date') && $request->order_date != null) {
            $query->whereDate('created_at', '=', $request->order_date);
        }

        if ($request->has('order_status') && $request->order_status != null) {
            $query->where('order_status', '=', $request->order_status);
        }

        return $query;
    }

    public function scopeDate($query, $request)
    {
        if ($request->has('order_date')) {
            $query->whereDate('order_date', '=', $request->order_date);
        }

        return $query;
    }

    public function scopeStatus($query, $request)
    {
        if ($request->has('order_status') && $request->order_status != "4") {
            $query->where('order_status', '=', $request->order_status);
        }

        return $query;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    // public function payment() {
    //     return $this->hasOne(Payment::class);
    // }



}
