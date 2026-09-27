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
    $table->id('product_id');
    $table->unsignedBigInteger('category_id');
    $table->string('product_name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->decimal('base_price', 12, 2);
    $table->string('thumbnail_url')->nullable();
    $table->timestamps();

    $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
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
