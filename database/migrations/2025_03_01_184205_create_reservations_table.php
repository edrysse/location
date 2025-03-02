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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained();
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->dateTime('pickup_date');
            $table->dateTime('return_date');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('payment_status')->default('pending'); // حالة الدفع
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
