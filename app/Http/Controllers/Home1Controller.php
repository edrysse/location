<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Models\Reservation;
use App\Models\CarSeasonPrice;
use App\Models\Contact;


class Home1Controller extends Controller
{

    public function index() {
        \App\Http\Controllers\CarController::incrementVisitor();
        $cars = Car::all();
        $reviews = Review::all();

        $featuredCars = Car::take(3)->get(); // أو أي شرط لتحديد السيارات المميزة
        return view('home.home', compact('cars', 'featuredCars','reviews'));

    }
    public function dashboard()
{
    $carsCount = Car::count();
    $reservationsCount = Reservation::count();
    $reviewsCount = Review::count();
    $contactsCount = Contact::count();
    $latestReservations = Reservation::orderBy('created_at', 'desc')->limit(5)->get();

    return view('dashboard', compact('carsCount', 'reservationsCount', 'reviewsCount', 'contactsCount', 'latestReservations'));
}

}
