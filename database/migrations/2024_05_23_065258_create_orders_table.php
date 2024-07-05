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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('fullname');
            $table->string('email');
            $table->string('phone_number');
            $table->string('address');
            $table->string('note');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons');
            $table->integer('sub_total');
            $table->integer('discount')->default(0);
            $table->integer('grand_total');
            // $table->foreignId('payment_method_id')->constrained('payments');
            $table->string('payment_method');
            $table->integer('order_status')->comment('0: Cancel, 1: Pending, 2: Delivery, 3: Completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
