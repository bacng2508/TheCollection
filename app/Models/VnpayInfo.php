<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VnpayInfo extends Model
{
    use HasFactory;

    protected $table = 'vnpay_info';

    protected $fillable = [
        'order_id',
        'vnp_TmnCode', 
        'vnp_Amount', 
        'vnp_BankCode', 
        'vnp_PayDate', 
        'vnp_OrderInfo', 
        'vnp_TransactionNo', 
        'vnp_ResponseCode',
        'vnp_TransactionStatus',
        'vnp_TxnRef',
    ];
}
