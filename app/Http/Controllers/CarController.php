<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('available', true);

        // فلترة السيارات بناءً على معايير البحث
        if ($request->filled('pickup_location')) {
            // نستخدم حقل "location" لفلترة السيارات حسب موقع الاستلام
            $query->where('location', $request->pickup_location);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

          // تم إزالة فلترة النوع (type)
    // if ($request->filled('type')) {
    //     $query->where('type', $request->type);
    // }
        if ($request->filled('fuel')) {
            $query->where('fuel', $request->fuel);
        }

        if ($request->filled('ac')) {
            // تحويل القيمة إلى boolean
            $query->where('ac', filter_var($request->ac, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $cars = $query->get();

        // نمرر معايير البحث إلى العرض لإظهار القيم المحددة
        return view('cars', compact('cars'))
            ->with($request->only([
                'pickup_location', 'name', 'type', 'fuel', 'ac', 'transmission', 'location',
            ]));
    }

    public function adminindex(Request $request)
    {
        $query = Car::where('available', true);

        if ($request->filled('pickup_location')) {
            $query->where('location', $request->pickup_location);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // تم إزالة فلترة النوع (type)
    // if ($request->filled('type')) {
    //     $query->where('type', $request->type);
    // }

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
                'pickup_location', 'name', 'type', 'fuel', 'ac', 'transmission', 'location'
            ]));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        // 'type' => 'required', // تمت إزالته
        'fuel' => 'required',
            'seats' => 'required|integer',
            'luggage' => 'required|integer',
            'ac' => 'required|boolean',
            'transmission' => 'required',
            'price_2_5_days' => 'required|numeric',
            'price_6_10_days' => 'required|numeric',
            'price_20_days' => 'required|numeric',
            'location' => 'required',
            'available' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0', // تأكد من أن الحقل price مطلوب

        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        Car::create($data);

        return redirect()->route('cars.index')->with('success', 'السيارة تم إنشاؤها بنجاح.');
    }

    public function show(Car $car)
    {
        return view('cars.index', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required',
        // 'type' => 'required', // تمت إزالته
        'fuel' => 'required',
            'seats' => 'required|integer',
            'luggage' => 'required|integer',
            'ac' => 'required|boolean',
            'transmission' => 'required',
            'price_2_5_days' => 'required|numeric',
            'price_6_10_days' => 'required|numeric',
            'price_20_days' => 'required|numeric',
            'location' => 'required',
            'available' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0', // تأكد من أن الحقل price مطلوب

        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);

        return redirect()->route('cars.index')->with('success', 'تم تحديث السيارة بنجاح.');
    }

    // في كنترولر CarController

    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // تعطيل التحقق من القيود
        Car::where('id', $id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // إعادة التحقق من القيود

        return redirect()->route('cars.index')->with('success', 'تم حذف السيارة بنجاح');
    }
    public function availableCars()
    {
        // جلب جميع السيارات
        $cars = Car::all();
    
        // تمرير السيارات إلى الفيو
        return view('cars.available_cars', compact('cars'));
    }
    public function checkAvailability(Request $request)
{
    $carId = $request->input('car_id');
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
        return response()->json(['available' => false, 'message' => 'عذرًا، السيارة غير متاحة في الفترة المحددة. يرجى اختيار تاريخ آخر.']);
    }

    return response()->json(['available' => true]);
}
}
