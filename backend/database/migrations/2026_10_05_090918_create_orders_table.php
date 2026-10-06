<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // id - Mã đơn hàng (INT, PK, AUTO_INCREMENT)
            // Khóa ngoại liên kết với bảng users (khách hàng)
            // Lưu ý: Nếu trong dự án của bạn bảng người dùng tên khác (ví dụ: 'customers'), hãy thay thế 'users' thành tên bảng đó.
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->decimal('total', 12, 2); // Tổng tiền
            $table->string('status', 50)->default('Chờ xác nhận'); // Trạng thái đơn hàng
            $table->string('address', 255); // Địa chỉ nhận
            $table->string('phone', 20); // SĐT nhận hàng
            $table->timestamps(); // Tự động quản lý created_at và updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};