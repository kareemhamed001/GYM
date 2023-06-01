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
        Schema::create('part_files', function (Blueprint $table) {
            $table->id();
            $table->string('title',200)->nullable();
            $table->text('description')->nullable();
            $table->string('path')->nullable();
            $table->unsignedBigInteger('part_id');
            $table->foreign('part_id')->references('id')->on('parts')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_files');
    }
};
