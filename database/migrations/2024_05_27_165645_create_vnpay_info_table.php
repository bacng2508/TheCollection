<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vnpay_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->string('vnp_TmnCode');
            $table->integer('vnp_Amount');
            $table->string('vnp_BankCode');
            $table->string('vnp_PayDate');
            $table->string('vnp_OrderInfo');
            $table->string('vnp_TransactionNo');
            $table->string('vnp_ResponseCode');
            $table->string('vnp_TransactionStatus');
            $table->string('vnp_TxnRef');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vnpay_info');
    }
};
