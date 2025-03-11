<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    protected $fillable = [
        'pickup_location', 'dropoff_location', 'pickup_date', 'return_date',
        'car_id',
         'name', 'email', 'phone', 'payment_status', 'payment_method',
        'gps', 'maxicosi', 'siege_bebe', 'rehausseur', 'full_tank', 'franchise', 'total_price','car_name'
    ];


    // علاقة مع Car

    public function car()
    {
        return $this->belongsTo(Car::class)->withDefault();
    }
}
