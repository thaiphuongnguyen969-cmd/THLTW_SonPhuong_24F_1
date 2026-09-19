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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Đơn hàng chứa sản phẩm
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // Sản phẩm
            // Nullable để vẫn giữ lịch sử đơn hàng nếu sản phẩm bị xóa
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            // Lưu tên sản phẩm tại thời điểm đặt hàng
            $table->string('product_name');

            // Số lượng
            $table->unsignedInteger('quantity');

            // Đơn giá tại thời điểm đặt hàng
            $table->decimal('price', 15, 2);

            // Thành tiền
            $table->decimal('subtotal', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};