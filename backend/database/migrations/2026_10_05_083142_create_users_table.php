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
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // id INT, PK, AUTO_INCREMENT
        $table->string('name', 100); // Họ tên
        $table->string('email', 100)->unique(); // Email
        $table->string('password', 255); // Mật khẩu
        $table->string('phone', 20)->nullable(); // Số điện thoại
        $table->string('address', 255)->nullable(); // Địa chỉ
        $table->timestamps(); // Bao gồm created_at và updated_at
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
