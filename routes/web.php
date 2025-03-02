<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::resource('cars', CarController::class);

Route::resource('reservations', ReservationController::class);


Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
