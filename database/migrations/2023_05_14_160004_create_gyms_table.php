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
        Schema::create('gyms', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number',20)->nullable();
            $table->string('cover_image');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('name_ku');
            $table->text('description_en');
            $table->text('description_ar');
            $table->text('description_ku');
            $table->integer('price');
            $table->time('open_at');
            $table->time('close_at');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};
