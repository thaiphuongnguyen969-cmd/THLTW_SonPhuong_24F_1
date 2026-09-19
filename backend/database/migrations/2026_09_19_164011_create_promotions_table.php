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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            // Mã khuyến mãi, ví dụ: SALE10
            $table->string('code')->unique();

            // Tên chương trình khuyến mãi
            $table->string('name');

            // Loại giảm giá: phần trăm hoặc số tiền cố định
            $table->enum('discount_type', ['percent', 'fixed']);

            // Giá trị giảm
            $table->decimal('discount_value', 15, 2);

            // Giá trị đơn hàng tối thiểu để được áp dụng
            $table->decimal('min_order_value', 15, 2)->default(0);

            // Mức giảm tối đa, chủ yếu dùng cho giảm theo %
            $table->decimal('max_discount', 15, 2)->nullable();

            // Số lần được sử dụng tối đa
            $table->unsignedInteger('usage_limit')->nullable();

            // Số lần đã sử dụng
            $table->unsignedInteger('used_count')->default(0);

            // Thời gian bắt đầu
            $table->dateTime('start_at');

            // Thời gian kết thúc
            $table->dateTime('end_at');

            // Trạng thái hoạt động
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};