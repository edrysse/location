<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        // إذا لم يتم تمرير قيمة الشهر من الفلترة، نستخدم الشهر الحالي بصيغة "YYYY-MM"
        $selectedMonth = $request->input('month', Carbon::now()->format('Y-m'));

        // إنشاء تاريخ بداية ونهاية الشهر المطلوب
        $startDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $endDate   = Carbon::createFromFormat('Y-m', $selectedMonth)->endOfMonth();

        // حساب الإحصائيات لهذا الشهر
        $totalReservations = Reservation::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalIncome = Reservation::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->sum('total_price');
        $uniqueCars = Reservation::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('car_id')
            ->count('car_id');

        // تطبيق فلترة إضافية على الحجوزات للجدول (دون أن تتأثر بيانات الجدول بقيمة "month")
        $query = Reservation::query();
        if ($request->filled('reservation_date')) {
            $query->whereDate('created_at', $request->reservation_date);
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        $reservations = $query->get();

        return view('reservations.index', compact(
            'reservations',
            'totalReservations',
            'totalIncome',
            'uniqueCars'
        ))->with($request->only(['reservation_date', 'name', 'start_date', 'end_date', 'month']));
    }

    public function create(Request $request)
    {
        $carId = $request->input('car_id');
        $car = Car::find($carId);

        if (!$car) {
            return redirect()->back()->withErrors('العربة غير موجودة!');
        }

        $data = [
            'car_name'        => $car->name,
            'car_price'       => $car->price,
            'pickup_location' => $request->input('pickup_location'),
            'dropoff_location'=> $request->input('dropoff_location'),
            'pickup_date'     => $request->input('pickup_date'),
            'return_date'     => $request->input('return_date'),
            'car_id'          => $carId,
        ];

        return view('reservations.create', compact('data'));
    }

    // دالة تأكد الحجز
    public function confirm(Request $request)
    {
        $data = $request->validate([
            'car_id'          => 'required|exists:cars,id',
            'pickup_location' => 'required|string',
            'dropoff_location'=> 'required|string',
            'pickup_date'     => 'required|date',
            'return_date'     => 'required|date|after:pickup_date',
        ]);

        return redirect()->route('reservations.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id'          => 'required|exists:cars,id',
            'pickup_location' => 'required|string|max:255',
            'dropoff_location'=> 'required|string|max:255',
            'pickup_date'     => 'required|date|after_or_equal:today',
            'return_date'     => 'required|date|after:pickup_date',
            'name'            => 'required|string|max:255',
            'email'           => 'required|email',
            'phone'           => 'required|string|max:20',
            'payment_status'  => 'required|string',
            'payment_method'  => 'nullable|string',
            'gps'             => 'nullable|boolean',
            'maxicosi'        => 'nullable|integer|min:0|max:2',
            'siege_bebe'      => 'nullable|integer|min:0|max:2',
            'rehausseur'      => 'nullable|integer|min:0|max:2',
            'full_tank'       => 'nullable|boolean',
            'franchise'       => 'nullable|boolean',
        ]);
    
        if (!$this->isCarAvailable($validated['car_id'], $validated['pickup_date'], $validated['return_date'])) {
            return redirect()->back()->withErrors(['error' => 'عذرًا، السيارة غير متاحة في الفترة المحددة. يرجى اختيار تاريخ آخر.']);
        }
    
        $car = Car::findOrFail($validated['car_id']);
        $days = (new \DateTime($validated['return_date']))->diff(new \DateTime($validated['pickup_date']))->days;
    
        // حساب السعر بناءً على عدد الأيام
        if ($days >= 2 && $days <= 5) {
            $totalPrice = $car->price_2_5_days * $days;
        } elseif ($days >= 6 && $days <= 10) {
            $totalPrice = $car->price_6_10_days * $days;
        } elseif ($days >= 20) {
            $totalPrice = $car->price_20_days * $days;
        } else {
            $totalPrice = $car->price * $days;
        }
    
        // إضافة تكاليف الخيارات الإضافية
        $totalPrice += (($validated['gps'] ?? false) ? 1 * $days : 0) +
            (($validated['maxicosi'] ?? 0) * $days) +
            (($validated['siege_bebe'] ?? 0) * $days) +
            (($validated['rehausseur'] ?? 0) * $days) +
            (($validated['full_tank'] ?? false) ? 60 : 0) +
            (($validated['franchise'] ?? false) ? 6 : 0);
    
        $reservation = new Reservation();
        $reservation->fill($validated);
        $reservation->car_name = $car->name;
        $reservation->total_price = $totalPrice;
        $reservation->save();
    
        try {
            Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));
        } catch (Exception $e) {
            Log::error('خطأ أثناء إرسال تأكيد الحجز: ' . $e->getMessage());
        }
    
        return redirect()->route('reservations.index')->with('success', 'تم الحجز بنجاح!');
    }
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $cars = Car::all();
        return view('reservations.edit', compact('reservation', 'cars'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'dropoff_location'=> 'required|string|max:255',
            'pickup_date'     => 'required|date',
            'return_date'     => 'required|date|after:pickup_date',
            'car_id'          => 'required|exists:cars,id',
            'name'            => 'required|string|max:255',
            'email'           => 'required|email',
            'phone'           => 'required|string|max:20',
            'payment_status'  => 'required|string',
            'payment_method'  => 'nullable|string',
            'gps'             => 'nullable|boolean',
            'maxicosi'        => 'nullable|integer|min:0|max:2',
            'siege_bebe'      => 'nullable|integer|min:0|max:2',
            'rehausseur'      => 'nullable|integer|min:0|max:2',
            'full_tank'       => 'nullable|boolean',
            'franchise'       => 'nullable|boolean',
        ]);

        $reservation = Reservation::findOrFail($id);
        $car = Car::findOrFail($validated['car_id']);

        // تحديث بيانات الحجز
        $reservation->fill($validated);
        $reservation->car_name = $car->name;

        $days = (new \DateTime($validated['return_date']))->diff(new \DateTime($validated['pickup_date']))->days;

        $reservation->total_price = ($car->price * $days) +
            (($validated['gps'] ?? false) ? 1 * $days : 0) +
            (($validated['maxicosi'] ?? 0) * $days) +
            (($validated['siege_bebe'] ?? 0) * $days) +
            (($validated['rehausseur'] ?? 0) * $days) +
            (($validated['full_tank'] ?? false) ? 60 : 0) +
            (($validated['franchise'] ?? false) ? 6 : 0);

        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'تم التعديل بنجاح!');
    }

    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح!');
    }
    protected function isCarAvailable($carId, $pickupDate, $returnDate)
{
    $existingReservations = Reservation::where('car_id', $carId)
        ->where(function ($query) use ($pickupDate, $returnDate) {
            $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                  ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                  ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                      $query->where('pickup_date', '<=', $pickupDate)
                            ->where('return_date', '>=', $returnDate);
                  });
        })
        ->where('payment_status', 'paid')
        ->exists();

    return !$existingReservations;
}

}
