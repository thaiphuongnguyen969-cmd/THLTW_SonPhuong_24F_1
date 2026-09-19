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
        Schema::create('stock_issue_items', function (Blueprint $table) {
            $table->id();

            // Phiếu xuất kho
            $table->foreignId('stock_issue_id')
                ->constrained('stock_issues')
                ->cascadeOnDelete();

            // Sản phẩm được xuất
            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            // Số lượng xuất
            $table->unsignedInteger('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_issue_items');
    }
};