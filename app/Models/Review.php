<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // تحديد الجدول المرتبط بهذا المودل
    protected $table = 'reviews';

    // تحديد الحقول التي يمكن تعبئتها بشكل جماعي (Mass Assignment)
    protected $fillable = [
        'name', // الاسم
        'position', // المسمى الوظيفي
        'comment', // التعليق
        'avatar', // صورة العميل
    ];

    // التواريخ التي سيتم إنشاؤها وتحديثها تلقائيًا
    public $timestamps = true;

    // إضافة حقل افتراضي للتقييم في حالة عدم توفيره


}
