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
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments("booking_id");
            $table->foreign("hotel_code")->references("hotel_code")->on("hotels")->onDelete('cascade');
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreign("room_id")->references("room_id")->on("rooms")->onDelete("cascade");
            $table->date("booking_date");
            $table->date("check_out_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
