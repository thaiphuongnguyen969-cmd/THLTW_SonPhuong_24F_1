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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Mã đơn hàng
            $table->string('order_code')->unique();

            // Thành viên đặt hàng
            // Nullable vì khách chưa đăng nhập cũng có thể đặt hàng
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Mã khuyến mãi được sử dụng
            $table->foreignId('promotion_id')
                ->nullable()
                ->constrained('promotions')
                ->nullOnDelete();

            // Thông tin người nhận
            $table->string('customer_name');
            $table->string('customer_phone', 20);
            $table->string('customer_email')->nullable();

            // Địa chỉ giao hàng
            $table->text('shipping_address');

            // Tiền hàng trước giảm giá
            $table->decimal('subtotal', 15, 2);

            // Số tiền được giảm
            $table->decimal('discount_amount', 15, 2)->default(0);

            // Phí vận chuyển
            $table->decimal('shipping_fee', 15, 2)->default(0);

            // Tổng tiền phải thanh toán
            $table->decimal('total_amount', 15, 2);

            // Phương thức thanh toán
            $table->enum('payment_method', [
                'cod',
                'bank_transfer'
            ])->default('cod');

            // Trạng thái thanh toán
            $table->enum('payment_status', [
                'unpaid',
                'paid',
                'refunded'
            ])->default('unpaid');

            // Trạng thái đơn hàng
            $table->enum('status', [
                'pending',
                'confirmed',
                'shipping',
                'completed',
                'cancelled'
            ])->default('pending');

            // Ghi chú của khách hàng
            $table->text('note')->nullable();

            // Thời điểm đặt hàng
            $table->dateTime('ordered_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};