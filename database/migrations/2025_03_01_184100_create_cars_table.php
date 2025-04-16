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
            $table->string('fuel');
            $table->integer('seats');
            $table->string('transmission');
            $table->decimal('price', 8, 2);
            $table->decimal('price_2_days', 8, 2);
            $table->decimal('price_3_7_days', 8, 2);
            $table->decimal('price_7_plus_days', 8, 2);
            $table->decimal('franchise_price', 8, 2)->nullable();
            $table->decimal('rachat_franchise_price', 8, 2)->nullable();
            $table->decimal('full_tank_price', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('location');
            $table->boolean('available')->default(true);
            $table->integer('kilometer')->default(0);

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
