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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments("room_id");
            $table->foreign("type_room_id")->references('type_room_id')->on("type_rooms")->onDelete('cascade');
            $table->foreign("hotel_id")->references('hotel_id')->on("hotels")->onDelete('cascade');
            $table->string("room_name");
            $table->float("price",8,2);
            $table->longText("room_desc");
            $table->boolean("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
