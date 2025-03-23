<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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
     * عرض قائمة الحجوزات مع إحصائيات الشهر المحدد.
     */
    public function index(Request $request)
    {
        // تحديد الشهر المطلوب (افتراضي الشهر الحالي)
        $selectedMonth = $request->input('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $endDate   = Carbon::createFromFormat('Y-m', $selectedMonth)->endOfMonth();

        // إحصائيات الشهر
        $totalReservations = Reservation::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalIncome = Reservation::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->sum('total_price');
        $uniqueCars = Reservation::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('car_id')
            ->count('car_id');

        // فلترة الحجوزات بناءً على معايير إضافية
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
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(10);

        return view('reservations.index', compact(
            'reservations',
            'totalReservations',
            'totalIncome',
            'uniqueCars'
        ))->with($request->only(['reservation_date', 'name', 'start_date', 'end_date', 'month']));
    }

    /**
     * عرض نموذج إنشاء حجز جديد.
     */
    public function create(Request $request)
{
    $carId = $request->input('car_id');
    $car = Car::find($carId);

    if (!$car) {
        return redirect()->back()->withErrors('العربة غير موجودة!');
    }

    // حساب عدد الأيام بين تواريخ الحجز المُرسلة
    $pickupDate = Carbon::parse($request->input('pickup_date'));
    $returnDate = Carbon::parse($request->input('return_date'));
    $days = $pickupDate->diffInDays($returnDate);

    // البحث عن سجل أسعار الفصل المناسب بناءً على تاريخ الاستلام
    $seasonPriceModel = $car->seasonPrices()
        ->where('start_date', '<=', $pickupDate)
        ->where('end_date', '>=', $pickupDate)
        ->first();

    if ($seasonPriceModel) {
        $isSeason = true;
        // نفترض أن سجل الأسعار الموسمية يحتوي على الحقول التالية
        $pricePerDay = $seasonPriceModel->price_per_day ?? $car->price;
        $price2to5   = $seasonPriceModel->price_2_5_days;
        $price6to20  = $seasonPriceModel->price_6_20_days;
        $pricePlus20 = $seasonPriceModel->price_20_plus_days;
    } else {
        $isSeason = false;
        // إذا لم يوجد سجل للفصل، تأكد من تمرير أسعار السيارة الأساسية
        $pricePerDay = $car->price;
        // استخدم السعر المخصص للحجز بين 2-5 أيام إن وُجد، أو السعر الأساسي كافتراضي
        $price2to5   = $car->price_2_5_days ?: $car->price;
        $price6to20  = $car->price_6_20_days ?: $car->price;
        $pricePlus20 = $car->price_20_plus_days ?: $car->price;
    }

    $data = [
        'price_per_day'   => $pricePerDay,
        'price_2_to_5'    => $price2to5,
        'price_6_to_20'   => $price6to20,
        'price_plus_20'   => $pricePlus20,
        'is_season'       => $isSeason,
        'franchise_price' => $car->franchise_price ?? 6,
        'pickup_date'     => $request->input('pickup_date'),
        'return_date'     => $request->input('return_date'),
        'car_name'        => $car->name,
        'pickup_location' => $request->input('pickup_location'),
        'dropoff_location'=> $request->input('dropoff_location'),
        'car_id'          => $carId,
    ];

    return view('reservations.create', compact('data'));
}


    /**
     * دالة تأكيد الحجز قبل الانتقال لنموذج الإضافة.
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
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }
    
    /**
     * تخزين بيانات الحجز بعد التأكد من صحة البيانات وحساب السعر.
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
        ]);

        // التحقق من توافر السيارة للفترة المحددة
        if (!$this->isCarAvailable($validated['car_id'], $validated['pickup_date'], $validated['return_date'])) {
            return redirect()->back()->withErrors(['error' => 'عذرًا، السيارة غير متاحة في الفترة المحددة. يرجى اختيار تاريخ آخر.']);
        }

        $car = Car::findOrFail($validated['car_id']);

        // حساب عدد الأيام بين تاريخ الاستلام والإرجاع
        $pickupDate = new \DateTime($validated['pickup_date']);
        $returnDate = new \DateTime($validated['return_date']);
        $days = $pickupDate->diff($returnDate)->days;

        // محاولة استدعاء سجل أسعار الفصل المناسب إذا كان موجوداً
        $seasonPriceModel = $car->seasonPrices()
            ->where('start_date', '<=', $validated['pickup_date'])
            ->where('end_date', '>=', $validated['pickup_date'])
            ->first();

        if ($seasonPriceModel) {
            // إذا وجد سجل أسعار للفصل، نستخدمه
            if ($days >= 2 && $days <= 5) {
                $dailyPrice = $seasonPriceModel->price_2_5_days;
            } elseif ($days >= 6 && $days <= 20) {
                $dailyPrice = $seasonPriceModel->price_6_20_days;
            } elseif ($days > 20) {
                $dailyPrice = $seasonPriceModel->price_20_plus_days;
            } else {
                $dailyPrice = $car->price;
            }
        } else {
            // في حال عدم وجود سجل للفصول، نستخدم الأسعار المتدرجة من جدول السيارة
            if ($days >= 2 && $days <= 5) {
                $dailyPrice = $car->price_2_5_days;
            } elseif ($days >= 6 && $days <= 20) {
                $dailyPrice = $car->price_6_20_days;
            } elseif ($days > 20) {
                $dailyPrice = isset($car->price_20_plus_days) ? $car->price_20_plus_days : $car->price;
            } else {
                $dailyPrice = $car->price;
            }
        }

        $totalPrice = $dailyPrice * $days;

        // إضافة التكاليف الخاصة بالخيارات الإضافية
        $totalPrice +=
              (($validated['gps'] ?? false) ? 1 * $days : 0)
            + (($validated['maxicosi'] ?? 0) * $days)
            + (($validated['siege_bebe'] ?? 0) * $days)
            + (($validated['rehausseur'] ?? 0) * $days)
            + (($validated['full_tank'] ?? false) ? 60 : 0)
            + (($validated['franchise'] ?? false) ? $car->franchise_price : 0);

        // إنشاء سجل الحجز
        $reservation = new Reservation();
        $reservation->fill($validated);
        $reservation->car_name = $car->name;
        $reservation->total_price = $totalPrice;
        $reservation->save();

        // محاولة إرسال تأكيد الحجز عبر البريد الإلكتروني
        try {
            Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));
        } catch (Exception $e) {
            Log::error('خطأ أثناء إرسال تأكيد الحجز: ' . $e->getMessage());
        }

        // التوجيه إلى الصفحة المناسبة بناءً على نوع المستخدم
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->route('reservations.index')->with('success', 'تم الحجز بنجاح!');
        }


        // إذا كان المستخدم غير مسجل أو ليس مديرًا، يتم نقله إلى الصفحة الرئيسية
        return redirect()->route('home')->with('success', 'تم الحجز بنجاح!');
    }

    /**
     * عرض نموذج تعديل بيانات الحجز.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $cars = Car::all();
        return view('reservations.edit', compact('reservation', 'cars'));
    }

    /**
     * تحديث بيانات الحجز وحساب السعر بناءً على البيانات المرسلة.
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
        ]);

        $reservation = Reservation::findOrFail($id);
        $car = Car::findOrFail($validated['car_id']);

        $reservation->fill($validated);
        $reservation->car_name = $car->name;

        $pickupDate = new \DateTime($validated['pickup_date']);
        $returnDate = new \DateTime($validated['return_date']);
        $days = $pickupDate->diff($returnDate)->days;

        // استدعاء سجل أسعار الفصل المناسب بناءً على تاريخ الاستلام
        $seasonPriceModel = $car->seasonPrices()
            ->where('start_date', '<=', $validated['pickup_date'])
            ->where('end_date', '>=', $validated['pickup_date'])
            ->first();

        if ($seasonPriceModel) {
            if ($days >= 2 && $days <= 5) {
                $dailyPrice = $seasonPriceModel->price_2_5_days;
            } elseif ($days >= 6 && $days <= 20) {
                $dailyPrice = $seasonPriceModel->price_6_20_days;
            } elseif ($days > 20) {
                $dailyPrice = $seasonPriceModel->price_20_plus_days;
            } else {
                $dailyPrice = $car->price;
            }
        } else {
            $dailyPrice = $car->price;
        }

        $reservation->total_price = ($dailyPrice * $days) +
            (($validated['gps'] ?? false) ? 1 * $days : 0) +
            (($validated['maxicosi'] ?? 0) * $days) +
            (($validated['siege_bebe'] ?? 0) * $days) +
            (($validated['rehausseur'] ?? 0) * $days) +
            (($validated['full_tank'] ?? false) ? 60 : 0) +
            (($validated['franchise'] ?? false) ? $car->franchise_price : 0);

        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'تم التعديل بنجاح!');
    }

    /**
     * حذف الحجز.
     */
    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح!');
    }

    /**
     * دالة تحقق توافر السيارة في الفترة المحددة.
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
}
