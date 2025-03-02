<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Reservation;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $reservation = Reservation::findOrFail($request->reservation_id);

        Charge::create([
            'amount' => $reservation->car->price_2_5_days * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Payment for reservation #' . $reservation->id,
        ]);

        $reservation->update(['payment_status' => 'paid']);

        return redirect()->route('reservations.index')->with('success', 'Payment successful!');
    }
}
