<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
     public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('price', 8, 2); // أضف عمود السعر
        });
    }

    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('price'); // هذا يحذف العمود في حالة التراجع
        });
    }
};
