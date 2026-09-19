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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            // Tiêu đề banner
            $table->string('title')->nullable();

            // Hình ảnh banner
            $table->string('image');

            // Link khi người dùng click vào banner
            $table->string('link')->nullable();

            // Thứ tự hiển thị
            $table->unsignedInteger('sort_order')->default(0);

            // Trạng thái hiển thị
            $table->boolean('is_active')->default(true);

            // Thời gian bắt đầu hiển thị
            $table->dateTime('start_at')->nullable();

            // Thời gian kết thúc hiển thị
            $table->dateTime('end_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};