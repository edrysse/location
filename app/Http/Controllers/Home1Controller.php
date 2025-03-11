<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;

use Illuminate\Http\Request;

class Home1Controller extends Controller
{

    public function index() {
        $cars = Car::all();
        $reviews = Review::all();

        $featuredCars = Car::take(3)->get(); // أو أي شرط لتحديد السيارات المميزة
        return view('home.home', compact('cars', 'featuredCars','reviews'));

    }
}
