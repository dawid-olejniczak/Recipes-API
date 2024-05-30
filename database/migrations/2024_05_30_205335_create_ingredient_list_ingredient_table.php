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
        Schema::create('ingredient_list_ingredient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingredients_list_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->integer('quantity');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('ingredients_list_id')->references('id')->on('ingredients_lists')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_list_ingredient');
    }
};
