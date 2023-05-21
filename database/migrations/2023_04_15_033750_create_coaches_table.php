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
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('nick_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('description')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('experience')->comment('number of years')->nullable();
            $table->string('intro_video')->comment('number of years')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
