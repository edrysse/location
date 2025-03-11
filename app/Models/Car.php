<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'fuel',
        'seats',
        'luggage',
        'ac',
        'transmission',
        'price_2_5_days',
        'price_6_10_days',
        'price_20_days',
        'location',
        'image',
        'available',
        'price'
    ];
    public function reservations()
{
    return $this->hasMany(Reservation::class);
}

}
