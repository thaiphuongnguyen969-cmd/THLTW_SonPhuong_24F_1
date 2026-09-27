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
        Schema::create('addresses', function (Blueprint $table) {
    $table->id('address_id');
    $table->unsignedBigInteger('user_id');
    $table->string('receiver_name');
    $table->string('phone_number');
    $table->string('province');
    $table->string('district');
    $table->string('ward');
    $table->string('specific_address');
    $table->boolean('is_default')->default(false);
    $table->timestamps();

    $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
