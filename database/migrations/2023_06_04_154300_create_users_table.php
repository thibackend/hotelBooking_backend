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
            $table->increments('user_id');
            $table->foreign('role_id')->references("role_id")->on("users")->onDelete('cascade');
            $table->foreign("hotel_id")->references("hotel_id")->on("hotels")->onDelete('cascade')->nullable();
            $table->string("user_name");
            $table->string("email")->unique();
            $table->string("password");
            $table->integer("age");
            $table->string("address");
            $table->string("image");
            $table->string("phone");
            $table->timestamps();
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
