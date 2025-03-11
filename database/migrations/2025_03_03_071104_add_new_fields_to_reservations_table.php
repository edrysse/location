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
        Schema::table('reservations', function (Blueprint $table) {
            $table->boolean('gps')->nullable();
            $table->boolean('maxicosi')->nullable();
            $table->boolean('siege_bebe')->nullable();
            $table->boolean('rehausseur')->nullable();
            $table->boolean('full_tank')->nullable();
            $table->boolean('franchise')->nullable();
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['gps', 'maxicosi', 'siege_bebe', 'rehausseur', 'full_tank', 'franchise']);
        });
    }

};
