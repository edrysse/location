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
    Schema::create('car_season_prices', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('car_id');
        $table->string('season_name');
        $table->date('start_date');
        $table->date('end_date');
        $table->decimal('price_2_5_days', 8, 2);
        $table->decimal('price_6_20_days', 8, 2);
        $table->decimal('price_20_plus_days', 8, 2);
        $table->timestamps();

        $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_season_prices');
    }
};
