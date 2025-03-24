<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // تحقق إذا كان الجدول موجودًا
        if (!Schema::hasTable('reviews')) {
            // إنشاء الجدول إذا لم يكن موجودًا
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('position');
                $table->text('comment');
                $table->integer('rating')->default(5);
                $table->string('avatar')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
