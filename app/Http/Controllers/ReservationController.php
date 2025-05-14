<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mail\NewReservationAdmin;
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
    /**
     * Display the list of reservations with statistics for the selected month.
     */
    public function index(Request $request)
    {
        // تحديد الشهر المطلوب (افتراضي الشهر الحالي)
        $selectedMonth = $request->input('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $endDate   = Carbon::createFromFormat('Y-m', $selectedMonth)->endOfMonth();

        // احصائيات الشهر
        $totalReservations = Reservation::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalIncome = Reservation::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->sum('total_price');
        $uniqueCars = Reservation::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('car_id')
            ->count('car_id');

        // ترشيح الحجوزات بناءً على معايير إضافية
        $query = Reservation::query();
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('reservation_date')) {
            $query->whereDate('created_at', $request->reservation_date);
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        $reservations = $query->orderBy('created_at', 'desc')->paginate(10);

        // جلب السيارات الفريدة المستأجرة حسب الفلاتر أو الشهر
        $uniqueCarIds = (clone $query)
            ->select('car_id')
            ->distinct()
            ->pluck('car_id');
        $uniqueRentedCars = Car::whereIn('id', $uniqueCarIds)->get();

        // جلب الحجوزات لهذا الشهر فقط (لعرضها في المودال)
        $monthlyReservations = Reservation::whereBetween('created_at', [$startDate, $endDate])->latest()->get();

        return view('reservations.index', compact(
            'reservations',
            'totalReservations',
            'totalIncome',
            'uniqueCars',
            'uniqueRentedCars',
            'monthlyReservations'
        ))->with($request->only(['reservation_date', 'name', 'start_date', 'end_date', 'month']));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create(Request $request)
    {
        $carId = $request->input('car_id');
        $car = Car::find($carId);

        if (!$car) {
            return redirect()->back()->withErrors('Car not found!');
        }

        // حساب عدد الأيام بين تواريخ الحجز
        try {
            // التحقق من وجود التواريخ
            if (!$request->input('pickup_date') || !$request->input('return_date')) {
                $pickupDate = now();
                $returnDate = now()->addDay();
            } else {
                $pickupDate = Carbon::parse($request->input('pickup_date'))->startOfDay();
                $returnDate = Carbon::parse($request->input('return_date'))->startOfDay();
            }

            $days = max(1, $pickupDate->diffInDays($returnDate));

            // جلب بيانات الأسعار الموسمية إن وُجدت
            $seasonPriceModel = $car->seasonPrices()
                ->whereDate('start_date', '<=', $pickupDate->format('Y-m-d'))
                ->whereDate('end_date', '>=', $pickupDate->format('Y-m-d'))
                ->first();

            \Log::info('Date Check', [
                'pickup' => $pickupDate->format('Y-m-d'),
                'return' => $returnDate->format('Y-m-d'),
                'days' => $days,
                'found_season' => $seasonPriceModel ? true : false
            ]);

            if ($seasonPriceModel) {
                $data = [
                    'car' => $car,
                    'car_id' => $car->id,
                    'pickup_date' => $pickupDate->format('Y-m-d'),
                    'return_date' => $returnDate->format('Y-m-d'),
                    'pickup_location' => $request->input('pickup_location'),
                    'return_location' => $request->input('dropoff_location'),
                    'season_price' => $seasonPriceModel,
                    'franchise_price' => $car->franchise_price,
                    'rachat_franchise_price' => $car->rachat_franchise_price
                ];
            } else {
                $data = [
                    'car' => $car,
                    'car_id' => $car->id,
                    'pickup_date' => $pickupDate->format('Y-m-d'),
                    'return_date' => $returnDate->format('Y-m-d'),
                    'pickup_location' => $request->input('pickup_location'),
                    'return_location' => $request->input('dropoff_location'),
                    'price_per_day' => $car->price,
                    'price_2_days' => $car->price_2_days,
                    'price_3_7_days' => $car->price_3_7_days,
                    'price_7_plus_days' => $car->price_7_plus_days,
                    'franchise_price' => $car->franchise_price,
                    'rachat_franchise_price' => $car->rachat_franchise_price
                ];
            }

            return view('reservations.create', compact('data'));
        } catch (\Exception $e) {
            \Log::error('Error in reservation creation', [
                'error' => $e->getMessage(),
                'car_id' => $carId
            ]);

            // استخدام الأسعار الافتراضية
            $data = [
                'car' => $car,
                'car_id' => $car->id,
                'pickup_date' => $pickupDate->format('Y-m-d'),
                'return_date' => $returnDate->format('Y-m-d'),
                'pickup_location' => $request->input('pickup_location'),
                'return_location' => $request->input('return_location'),
                'price_per_day' => $car->price,
                'price_2_days' => $car->price_2_days,
                'price_3_7_days' => $car->price_3_7_days,
                'price_7_plus_days' => $car->price_7_plus_days,
                'franchise_price' => $car->franchise_price,
                'rachat_franchise_price' => $car->rachat_franchise_price
            ];

            return view('reservations.create', compact('data'));
        }
    }

    /**
     * Confirm the reservation details before proceeding to the creation form.
     */
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

    /**
     * Display the specified reservation.
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Store a newly created reservation after validating data and calculating the price.
     * بعد اتمام عملية الحجز، يتم تجهيز رسالة واتساب احترافية تتضمن تفاصيل الحجز (باستثناء إجمالي السعر) ومن ثم
     * يتم إعادة التوجيه إلى صفحة "thankyou" التي تعرض رسالة نجاح وتفتح تبويب جديد لواتساب.
     */
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
            'rachat_franchise' => 'nullable|boolean',
        ]);

        // التحقق من توفر السيارة للفترة المطلوبة
        if (!$this->isCarAvailable($validated['car_id'], $validated['pickup_date'], $validated['return_date'])) {
            return redirect()->back()->withErrors(['error' => 'آسفون، السيارة غير متوفرة للفترة المحددة.']);
        }

        $car = Car::findOrFail($validated['car_id']);

        // حساب عدد الأيام بين تاريخ الاستلام والتسليم
        $pickupDateTime = Carbon::parse($validated['pickup_date']);
        $returnDateTime = Carbon::parse($validated['return_date']);
        $days = $pickupDateTime->diffInDays($returnDateTime);

        // استرجاع سجل التسعير الموسمي إن وجد
        $seasonPriceModel = $car->seasonPrices()
            ->where('start_date', '<=', $validated['pickup_date'])
            ->where('end_date', '>=', $validated['pickup_date'])
            ->first();

        if ($seasonPriceModel) {
            if ($days === 2) {
                $dailyPrice = $seasonPriceModel->price_2_days;
            } elseif ($days >= 3 && $days <= 7) {
                $dailyPrice = $seasonPriceModel->price_3_7_days;
            } elseif ($days > 7) {
                $dailyPrice = $seasonPriceModel->price_7_plus_days;
            } else {
                $dailyPrice = $car->price;
            }
        } else {
            if ($days === 2) {
                $dailyPrice = $car->price_2_days;
            } elseif ($days >= 3 && $days <= 7) {
                $dailyPrice = $car->price_3_7_days;
            } elseif ($days > 7) {
                $dailyPrice = $car->price_7_plus_days;
            } else {
                $dailyPrice = $car->price;
            }
        }

        $totalPrice = $dailyPrice * $days;

        // إضافة تكلفة الخيارات الإضافية
        $totalPrice +=
              (($validated['gps'] ?? false) ? 1 * $days : 0)
            + (($validated['maxicosi'] ?? 0) * $days)
            + (($validated['siege_bebe'] ?? 0) * $days)
            + (($validated['rehausseur'] ?? 0) * $days)
            + (($validated['full_tank'] ?? false) ? 60 : 0)
            + (($validated['franchise'] ?? false) ? $car->franchise_price : 0)
            + (($validated['rachat_franchise'] ?? false) ? $car->rachat_franchise_price : 0);

        // إنشاء سجل الحجز
        $reservation = new Reservation();
        $reservation->fill($validated);
        $reservation->car_name = $car->name;
        $reservation->total_price = $totalPrice;
        // احتفظ بالوقت الدقيق للحجز
        $reservation->pickup_date = $pickupDateTime->format('Y-m-d H:i:s');
        $reservation->return_date = $returnDateTime->format('Y-m-d H:i:s');
        $reservation->save();

        // إرسال الإشعارات عبر البريد الإلكتروني للمستخدم والإداري
        try {
            Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));
            $adminEmail = config('mail.admin_email'); // تأكد من تحديد المفتاح في إعدادات البريد
            Mail::to($adminEmail)->send(new NewReservationAdmin($reservation));
        } catch (Exception $e) {
            Log::error('Error while sending reservation emails: ' . $e->getMessage());
        }

        // إعداد رسالة واتساب احترافية تحتوي على تفاصيل الحجز مع رقم الحجز في الأعلى
        $locale = app()->getLocale();
        $message = "";
        if ($locale === 'ar') {
            $message = "حجز رقم #{$reservation->id}\nمرحباً،\nأرغب في تأكيد حجز سيارتي. التفاصيل:\nالسيارة: {$reservation->car_name}\nمكان الاستلام: {$reservation->pickup_location}\nمكان الإرجاع: {$reservation->dropoff_location}\nتاريخ الاستلام: " . Carbon::parse($reservation->pickup_date)->format('Y-m-d') . "\nتاريخ الإرجاع: " . Carbon::parse($reservation->return_date)->format('Y-m-d') . "\nيرجى تأكيد الحجز.";
        } elseif ($locale === 'fr') {
            $message = "Réservation N° #{$reservation->id}\nBonjour,\nJe souhaite confirmer ma réservation de voiture. Détails :\nVoiture : {$reservation->car_name}\nLieu de prise en charge : {$reservation->pickup_location}\nLieu de restitution : {$reservation->dropoff_location}\nDate de prise en charge : " . Carbon::parse($reservation->pickup_date)->format('Y-m-d') . "\nDate de restitution : " . Carbon::parse($reservation->return_date)->format('Y-m-d') . "\nMerci de confirmer la réservation.";
        } else {
            $message = "Reservation #{$reservation->id}\nHello,\nI would like to confirm my car reservation. Details:\nCar: {$reservation->car_name}\nPickup Location: {$reservation->pickup_location}\nDropoff Location: {$reservation->dropoff_location}\nPickup Date: " . Carbon::parse($reservation->pickup_date)->format('Y-m-d') . "\nReturn Date: " . Carbon::parse($reservation->return_date)->format('Y-m-d') . "\nPlease confirm the booking.";
        }
        $encodedMessage = urlencode($message);
        $waUrl = "https://wa.me/212660565730?text=" . $encodedMessage;
        
        // إذا كان المستخدم إداري يتم إعادة التوجيه إلى لوحة الحجوزات
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
        }

        // إعادة التوجيه إلى صفحة "thankyou" التي تعرض رسالة نجاح وتفتح تبويب جديد لواتساب
        return $this->sendWhatsappMessage($reservation);
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $cars = Car::all();
        return view('reservations.edit', compact('reservation', 'cars'));
    }

    /**
     * Update the specified reservation and recalculate the price based on the provided data.
     */
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
            'rachat_franchise' => 'nullable|boolean',
        ]);

        $reservation = Reservation::findOrFail($id);
        $car = Car::findOrFail($validated['car_id']);

        $reservation->fill($validated);
        $reservation->car_name = $car->name;

        $pickupDate = new \DateTime($validated['pickup_date']);
        $returnDate = new \DateTime($validated['return_date']);
        $days = $pickupDate->diff($returnDate)->days;

        // جلب سجل التسعير الموسمي بناءً على تاريخ الاستلام
        $seasonPriceModel = $car->seasonPrices()
            ->where('start_date', '<=', $validated['pickup_date'])
            ->where('end_date', '>=', $validated['pickup_date'])
            ->first();

        if ($seasonPriceModel) {
            if ($days === 2) {
                $dailyPrice = $seasonPriceModel->price_2_days;
            } elseif ($days >= 3 && $days <= 7) {
                $dailyPrice = $seasonPriceModel->price_3_7_days;
            } elseif ($days > 7) {
                $dailyPrice = $seasonPriceModel->price_7_plus_days;
            } else {
                $dailyPrice = $car->price;
            }
        } else {
            if ($days === 2) {
                $dailyPrice = $car->price_2_days;
            } elseif ($days >= 3 && $days <= 7) {
                $dailyPrice = $car->price_3_7_days;
            } elseif ($days > 7) {
                $dailyPrice = $car->price_7_plus_days;
            } else {
                $dailyPrice = $car->price;
            }
        }

        $reservation->total_price = ($dailyPrice * $days) +
            (($validated['gps'] ?? false) ? 1 * $days : 0) +
            (($validated['maxicosi'] ?? 0) * $days) +
            (($validated['siege_bebe'] ?? 0) * $days) +
            (($validated['rehausseur'] ?? 0) * $days) +
            (($validated['full_tank'] ?? false) ? 60 : 0) +
            (($validated['franchise'] ?? false) ? $car->franchise_price : 0) +
            (($validated['rachat_franchise'] ?? false) ? $car->rachat_franchise_price : 0);

        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
    }

    /**
     * Delete the specified reservation.
     */
    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Reservation deleted successfully!');
    }

    /**
     * Check if the car is available for the specified period.
     */
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

    /**
     * Get reservation count for a given month (1-12)
     */
    public static function countReservationsByMonth($month)
    {
        return Reservation::whereMonth('created_at', $month)->count();
    }

    /**
     * Send a WhatsApp message with the reservation details.
     */
    public function sendWhatsappMessage($reservation)
    {
        $id = $reservation->id;
        $name = $reservation->name;
        $car = $reservation->car_name;
        $pickup = $reservation->pickup_location;
        $date = $reservation->pickup_date;
        $msg = "حجزك رقم #$id\nالاسم: $name\nالسيارة: $car\nمكان التسليم: $pickup\nتاريخ التسليم: $date";
        $msg = urlencode($msg);
        $phone = '212660565730';
        $url = "https://wa.me/$phone?text=$msg";
        return redirect($url);
    }
}
