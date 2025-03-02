<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('home', compact('cars')); // تأكد من أن 'home' هو اسم الملف الصحيح
    }
}
