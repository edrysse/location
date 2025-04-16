<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeasonPrice extends Model
{
    protected $fillable = [
        'car_id',
        'name',
        'start_date',
        'end_date',
        'price_2_days',
        'price_3_7_days',
        'price_7_plus_days'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price_2_days' => 'decimal:2',
        'price_3_7_days' => 'decimal:2',
        'price_7_plus_days' => 'decimal:2'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
