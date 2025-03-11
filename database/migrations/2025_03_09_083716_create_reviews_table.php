<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // إضافة الحقول الجديدة
            $table->string('name');
            $table->string('position');
            // إزالة الحقل `user_id` إذا كنت لا تحتاجه
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // حذف الحقول الجديدة في حالة الرجوع
            $table->dropColumn('name');
            $table->dropColumn('position');
            // إعادة إضافة `user_id` إذا كنت بحاجة إليه
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }
};
