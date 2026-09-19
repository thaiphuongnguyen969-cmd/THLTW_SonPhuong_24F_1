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
        Schema::create('stock_receipts', function (Blueprint $table) {
            $table->id();

            // Mã phiếu nhập kho
            $table->string('receipt_code')->unique();

            // Admin/người tạo phiếu
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Nhà cung cấp
            $table->string('supplier_name')->nullable();

            // Ghi chú
            $table->text('note')->nullable();

            // Thời gian nhập kho
            $table->dateTime('received_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_receipts');
    }
};