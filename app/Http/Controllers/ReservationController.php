<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('reservations.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after:pickup_date',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'payment_method' => 'required|in:cash_on_delivery,online',
        ]);

        try {
            // Create the reservation
            $reservation = Reservation::create($request->all());

            // Send confirmation email
            Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));

            // Redirect with success message
            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating reservation: ' . $e->getMessage());

            // Redirect with detailed error message
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after:pickup_date',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
