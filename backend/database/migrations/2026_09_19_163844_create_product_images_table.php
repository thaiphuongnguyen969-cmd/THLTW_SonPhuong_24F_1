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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();

            // Sản phẩm sở hữu hình ảnh
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Đường dẫn hình ảnh
            $table->string('image');

            // Thứ tự hiển thị hình ảnh
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};