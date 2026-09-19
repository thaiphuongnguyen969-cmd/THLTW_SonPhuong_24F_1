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
        Schema::create('stock_issues', function (Blueprint $table) {
            $table->id();

            // Mã phiếu xuất kho
            $table->string('issue_code')->unique();

            // Admin/người tạo phiếu
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Lý do xuất kho
            $table->enum('reason', [
                'supplier_return',
                'damaged',
                'expired',
                'other'
            ]);

            // Ghi chú
            $table->text('note')->nullable();

            // Thời gian xuất kho
            $table->dateTime('issued_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_issues');
    }
};