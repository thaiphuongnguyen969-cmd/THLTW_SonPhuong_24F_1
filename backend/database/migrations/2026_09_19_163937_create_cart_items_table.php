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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            // Giỏ hàng chứa sản phẩm
            $table->foreignId('cart_id')
                ->constrained('carts')
                ->cascadeOnDelete();

            // Sản phẩm được thêm vào giỏ
            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            // Số lượng sản phẩm
            $table->unsignedInteger('quantity')->default(1);

            // Giá sản phẩm tại thời điểm thêm vào giỏ
            $table->decimal('price', 15, 2);

            $table->timestamps();

            // Một sản phẩm chỉ xuất hiện một lần trong cùng một giỏ
            $table->unique(['cart_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};