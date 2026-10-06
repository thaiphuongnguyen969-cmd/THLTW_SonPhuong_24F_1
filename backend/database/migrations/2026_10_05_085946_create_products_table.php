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
        $table->id(); // id INT, PK, AUTO_INCREMENT
        $table->unsignedBigInteger('category_id'); // Mã danh mục (FK)
        $table->string('name', 200); // Tên sản phẩm
        $table->text('description')->nullable(); // Mô tả
        $table->decimal('price', 12, 2); // Giá
        $table->string('image', 255)->nullable(); // Hình ảnh
        $table->integer('quantity')->default(0); // Số lượng tồn
        $table->timestamps(); // Ngày thêm (created_at, updated_at)

        // Thiết lập ràng buộc khóa ngoại (Foreign Key)
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
