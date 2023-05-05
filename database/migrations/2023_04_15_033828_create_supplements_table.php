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
        Schema::create('supplements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->string('name_ku')->nullable();
            $table->text('description');
            $table->text('description_ar')->nullable();
            $table->text('description_ku')->nullable();
            $table->integer('quantity');
            $table->text('unit')->comment('Unit of measurement ex.kg ');
            $table->integer('price');
            $table->integer('discount');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('coach_id');
            $table->string('cover_image');
            $table->timestamps();
            $table->foreign('coach_id')->references('id')->on('coaches')->cascadeOnDelete();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplements');
    }
};
