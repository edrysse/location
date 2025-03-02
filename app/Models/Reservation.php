<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

   protected $fillable = [
    'car_id',
    'pickup_location',
    'dropoff_location',
    'pickup_date',
    'return_date',
    'name',
    'email',
    'phone',
    'payment_method', // أضف هذا الحقل
];

    // علاقة مع Car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
