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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Liên kết danh mục
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            // Liên kết thương hiệu
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();

            // Giá bán
            $table->decimal('price', 15, 2);

            // Giá khuyến mãi
            $table->decimal('sale_price', 15, 2)->nullable();

            $table->text('description')->nullable();
            $table->longText('content')->nullable();

            // Ảnh đại diện sản phẩm
            $table->string('image')->nullable();

            // Số lượng tồn kho
            $table->unsignedInteger('stock')->default(0);

            // Sản phẩm nổi bật
            $table->boolean('is_featured')->default(false);

            // Trạng thái sản phẩm
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Xóa mềm sản phẩm
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};