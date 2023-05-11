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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('title_ku')->nullable();
            $table->text('description_en');
            $table->text('description_ar')->nullable();
            $table->text('description_ku')->nullable();
            $table->string('cover_image');
            $table->string('path');
            $table->unsignedBigInteger('coach_id');
            $table->timestamps();
            $table->foreign('coach_id')->references('id')->on('coaches')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
