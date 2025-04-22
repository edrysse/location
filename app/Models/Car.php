<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\CarSeasonPrice;
use App\Models\SeasonPrice;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fuel',
        'seats',
        'transmission',
        'price',
        'price_2_days',
        'price_3_7_days',
        'price_7_plus_days',
        'franchise_price',
        'rachat_franchise_price',
        'location',
        'image',
        'available',
        'kilometer',
        'doors',
        'bags'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function seasonPrices()
    {
        return $this->hasMany(SeasonPrice::class);
    }

    public function carSeasonPrices()
    {
        return $this->hasMany(CarSeasonPrice::class);
    }
}
