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
        // Log each visit
        \DB::table('visitor_logs')->insert([
            'ip' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
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

        // بيانات الرسم البياني الفعلية
        $visitorsLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $visitorsData = array_map(function($month) {
            return \App\Http\Controllers\CarController::countVisitorsByMonth($month);
        }, range(1, 12));

        $reservationsLabels = $visitorsLabels;
        $reservationsData = array_map(function($month) {
            return \App\Http\Controllers\ReservationController::countReservationsByMonth($month);
        }, range(1, 12));

        $carsLabels = $visitorsLabels;
        $carsData = array_map(function($month) {
            return Car::whereMonth('created_at', $month)->count();
        }, range(1, 12));

        $reviewsLabels = $visitorsLabels;
        $reviewsData = array_map(function($month) {
            return Review::whereMonth('created_at', $month)->count();
        }, range(1, 12));

        $contactsLabels = $visitorsLabels;
        $contactsData = array_map(function($month) {
            return Contact::whereMonth('created_at', $month)->count();
        }, range(1, 12));

        return view('dashboard', compact(
            'carsCount', 'reservationsCount', 'reviewsCount', 'contactsCount', 'latestReservations',
            'visitorsLabels', 'visitorsData',
            'reservationsLabels', 'reservationsData',
            'carsLabels', 'carsData',
            'reviewsLabels', 'reviewsData',
            'contactsLabels', 'contactsData'
        ));
    }
}
