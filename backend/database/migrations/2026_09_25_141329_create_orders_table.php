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
    $table->id('order_id');
    $table->unsignedBigInteger('user_id');
    $table->text('shipping_address');
    $table->decimal('total_amount', 12, 2);
    $table->decimal('shipping_fee', 10, 2)->default(0);
    $table->string('order_status')->default('Pending'); // Pending, Processing, Shipping, Completed, Cancelled
    $table->string('payment_method'); // COD, VNPAY, MOMO, Banking
    $table->string('payment_status')->default('Unpaid'); // Unpaid, Paid
    $table->timestamps();

    $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
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
