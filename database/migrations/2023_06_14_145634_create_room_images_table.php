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
        Schema::create('room_images', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->unsignedBigInteger("room_id");
            $table->unsignedBigInteger("hotel_id");
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete("cascade");
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_images');
    }
};
