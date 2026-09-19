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
        Schema::create('stock_receipt_items', function (Blueprint $table) {
            $table->id();

            // Phiếu nhập kho
            $table->foreignId('stock_receipt_id')
                ->constrained('stock_receipts')
                ->cascadeOnDelete();

            // Sản phẩm được nhập
            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            // Số lượng nhập
            $table->unsignedInteger('quantity');

            // Giá nhập của sản phẩm
            $table->decimal('import_price', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_receipt_items');
    }
};