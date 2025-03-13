<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSeasonPrice extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها بشكل جماعي.
     */
    protected $fillable = [
        'car_id',
        'season_name',
        'start_date',
        'end_date',
        'price_2_5_days',
        'price_6_20_days',
        'price_20_plus_days',
    ];

    /**
     * العلاقة مع نموذج السيارة (Car).
     * تربط أسعار الفصول بسيارة معينة.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
