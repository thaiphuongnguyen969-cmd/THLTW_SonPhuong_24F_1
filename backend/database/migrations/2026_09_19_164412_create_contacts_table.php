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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            // Người gửi nếu đã đăng nhập
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Thông tin người liên hệ
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20)->nullable();

            // Tiêu đề liên hệ
            $table->string('subject')->nullable();

            // Nội dung liên hệ
            $table->text('message');

            // Trạng thái xử lý
            $table->enum('status', [
                'pending',
                'processing',
                'resolved'
            ])->default('pending');

            // Phản hồi của Admin
            $table->text('admin_reply')->nullable();

            // Thời gian Admin phản hồi
            $table->dateTime('replied_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};