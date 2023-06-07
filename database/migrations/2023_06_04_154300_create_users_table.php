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
            $table->id();
            $table->unsignedBigInteger("role_id");
            $table->unsignedBigInteger("hotel_id");
            $table->string("user_name");
            $table->string("email")->unique();
            $table->string("password");
            $table->integer("age");
            $table->string("address");
            $table->string("image");
            $table->string("phone");
            $table->timestamps();
            $table->foreign('role_id')->references("id")->on("users")->onDelete('cascade');
            $table->foreign("hotel_id")->references("id")->on("hotels")->onDelete('cascade')->nullable();
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