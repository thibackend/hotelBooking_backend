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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText("comment");
            $table->unsignedBigInteger("hotel_id");
            $table->unsignedBigInteger("account_id");
            $table->timestamps();
            $table->foreign("account_id")->references("id")->on("accounts")->onDelete("cascade");
            $table->foreign("hotel_id")->references("id")->on("hotels")->onDelete("cascade");
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
