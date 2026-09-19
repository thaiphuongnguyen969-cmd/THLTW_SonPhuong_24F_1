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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Danh mục bài viết
            $table->foreignId('post_category_id')
                ->nullable()
                ->constrained('post_categories')
                ->nullOnDelete();

            // Người tạo bài viết
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Tiêu đề bài viết
            $table->string('title');

            // Đường dẫn thân thiện
            $table->string('slug')->unique();

            // Mô tả ngắn
            $table->text('excerpt')->nullable();

            // Nội dung bài viết
            $table->longText('content');

            // Ảnh đại diện
            $table->string('image')->nullable();

            // Trạng thái xuất bản
            $table->boolean('is_published')->default(false);

            // Thời gian xuất bản
            $table->dateTime('published_at')->nullable();

            $table->timestamps();

            // Xóa mềm
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};