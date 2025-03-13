<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('fuel');
            $table->integer('seats');
            $table->integer('luggage');
            $table->boolean('ac');
            $table->string('transmission');
            $table->decimal('price_2_5_days', 8, 2);
            $table->decimal('price_6_10_days', 8, 2);
            $table->decimal('price_20_days', 8, 2);
            $table->string('image')->nullable(); // إضافة حقل للصورة
            $table->string('location'); // إضافة حقل للموقع

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
