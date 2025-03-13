<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarSeasonPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // عرض قائمة السيارات للمستخدمين
    public function index(Request $request)
    {
        $query = Car::where('available', true);

        if ($request->filled('pickup_location')) {
            $query->where('location', $request->pickup_location);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('fuel')) {
            $query->where('fuel', $request->fuel);
        }

        if ($request->filled('ac')) {
            $query->where('ac', filter_var($request->ac, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $cars = $query->get();

        return view('cars', compact('cars'))
            ->with($request->only([
                'pickup_location', 'name', 'fuel', 'ac', 'transmission', 'location'
            ]));
    }

    // عرض قائمة السيارات في واجهة الأدمن
    public function adminindex(Request $request)
    {
        $query = Car::query();

        if ($request->filled('pickup_location')) {
            $query->where('location', $request->pickup_location);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('fuel')) {
            $query->where('fuel', $request->fuel);
        }

        if ($request->filled('ac')) {
            $query->where('ac', filter_var($request->ac, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $cars = $query->get();

        return view('cars.index', compact('cars'))
            ->with($request->only([
                'pickup_location', 'name', 'fuel', 'ac', 'transmission', 'location'
            ]));
    }

    // عرض نموذج إضافة سيارة جديدة
    public function create()
    {
        return view('cars.create');
    }

    // تخزين بيانات السيارة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'fuel'              => 'required|string|max:50',
            'seats'             => 'required|integer',
            'luggage'           => 'required|integer',
            'ac'                => 'required|boolean',
            'transmission'      => 'required|string|max:50',
            'price'             => 'required|numeric|min:0', // السعر الأساسي للسيارة
            // يمكن الاستمرار بالحقل القديم إذا كنت لا تزال بحاجة له (price_2_5_days، price_6_10_days، price_20_days)
            'price_2_5_days'    => 'required|numeric|min:0',
            'price_6_10_days'   => 'required|numeric|min:0',
            'price_20_days'     => 'required|numeric|min:0',
            'location'          => 'required|string|max:255',
            'available'         => 'required|boolean',
            'franchise_price'   => 'nullable|numeric|min:0', // سعر الـ Franchise الخاص بالسيارة
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // بيانات أسعار الفصول، حيث نتوقع مصفوفة من الأسعار
            'season_prices'                      => 'nullable|array',
            'season_prices.*.season_name'        => 'required_with:season_prices|string|max:100',
            'season_prices.*.start_date'         => 'required_with:season_prices|date',
            'season_prices.*.end_date'           => 'required_with:season_prices|date',
            'season_prices.*.price_2_5_days'     => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_6_20_days'    => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_20_plus_days' => 'required_with:season_prices|numeric|min:0',
        ]);

        $data = $request->all();

        // رفع الصورة إن وُجدت
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        // إنشاء السيارة في قاعدة البيانات
        $car = Car::create($data);

        // تخزين بيانات أسعار الفصول إذا تم إرسالها
        if ($request->has('season_prices')) {
            foreach ($request->season_prices as $seasonPriceData) {
                $car->seasonPrices()->create([
                    'season_name'       => $seasonPriceData['season_name'],
                    'start_date'        => $seasonPriceData['start_date'],
                    'end_date'          => $seasonPriceData['end_date'],
                    'price_2_5_days'    => $seasonPriceData['price_2_5_days'],
                    'price_6_20_days'   => $seasonPriceData['price_6_20_days'],
                    'price_20_plus_days'=> $seasonPriceData['price_20_plus_days'],
                    'franchise_price' => $car->franchise_price, 

                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'السيارة تم إنشاؤها بنجاح.');
    }

    // عرض تفاصيل سيارة محددة
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // عرض نموذج تعديل بيانات السيارة
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // تحديث بيانات السيارة
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'fuel'              => 'required|string|max:50',
            'seats'             => 'required|integer',
            'luggage'           => 'required|integer',
            'ac'                => 'required|boolean',
            'transmission'      => 'required|string|max:50',
            'price'             => 'required|numeric|min:0',
            'price_2_5_days'    => 'required|numeric|min:0',
            'price_6_10_days'   => 'required|numeric|min:0',
            'price_20_days'     => 'required|numeric|min:0',
            'location'          => 'required|string|max:255',
            'available'         => 'required|boolean',
            'franchise_price'   => 'nullable|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'season_prices'                      => 'nullable|array',
            'season_prices.*.season_name'        => 'required_with:season_prices|string|max:100',
            'season_prices.*.start_date'         => 'required_with:season_prices|date',
            'season_prices.*.end_date'           => 'required_with:season_prices|date',
            'season_prices.*.price_2_5_days'     => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_6_20_days'    => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_20_plus_days' => 'required_with:season_prices|numeric|min:0',
        ]);

        $data = $request->all();

        // رفع الصورة في حالة تعديلها
        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        // تحديث بيانات السيارة
        $car->update($data);

        // تحديث أسعار الفصول: حذف السجلات القديمة ثم إعادة إدخال الجديدة
        $car->seasonPrices()->delete();
        if ($request->has('season_prices')) {
            foreach ($request->season_prices as $seasonPriceData) {
                $car->seasonPrices()->create([
                    'season_name'       => $seasonPriceData['season_name'],
                    'start_date'        => $seasonPriceData['start_date'],
                    'end_date'          => $seasonPriceData['end_date'],
                    'price_2_5_days'    => $seasonPriceData['price_2_5_days'],
                    'price_6_20_days'   => $seasonPriceData['price_6_20_days'],
                    'price_20_plus_days'=> $seasonPriceData['price_20_plus_days'],
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'تم تحديث السيارة بنجاح.');
    }

    // حذف السيارة
    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Car::where('id', $id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('cars.index')->with('success', 'تم حذف السيارة بنجاح');
    }

    // عرض جميع السيارات بغرض الاستخدام في الحجز أو العرض العام
    public function availableCars()
    {
        $cars = Car::all();
        return view('cars.available_cars', compact('cars'));
    }

    // دالة التحقق من توافر السيارة لفترة محددة
    public function checkAvailability(Request $request)
    {
        $carId      = $request->input('car_id');
        $pickupDate = $request->input('pickup_date');
        $returnDate = $request->input('return_date');

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

        if ($existingReservations) {
            return response()->json([
                'available' => false,
                'message'   => 'عذرًا، السيارة غير متاحة في الفترة المحددة.'
            ]);
        }

        return response()->json(['available' => true]);
    }
}
