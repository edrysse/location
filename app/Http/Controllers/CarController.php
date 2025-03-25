<?php
namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarSeasonPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller

{
    // Display the list of cars to users
    public function index(Request $request)
    {
        // يمكنك وضع dd($request->all()); هنا للتحقق من القيم المستقبلة
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
            // تأكد من أن القيمة المرسلة تُحوّل بشكل صحيح إلى boolean
            $query->where('ac', filter_var($request->ac, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // حذف شرط "location" لأنه تم توحيده مع pickup_location

        $cars = $query->get();

        return view('cars', compact('cars'))
            ->with($request->only([
                'pickup_location', 'name', 'fuel', 'ac', 'transmission'
            ]));
    }
    public function availableCars()
    {
        // جلب السيارات المتاحة من قاعدة البيانات
        $cars = Car::all(); // يمكنك تعديل الاستعلام حسب احتياجك
        return view('cars.available_cars', compact('cars')); // تأكد أن اسم الفيو صحيح
    }
    // Display the list of cars in the admin interface
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

        // حذف شرط "location" لأنه تم توحيده مع pickup_location

        $cars = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('cars.index', compact('cars'))
            ->with($request->only([
                'pickup_location', 'name', 'fuel', 'ac', 'transmission'
            ]));
    }

    // Show the form to add a new car
    public function create()
    {
        return view('cars.create');
    }

    // Store the data of a new car
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'fuel'              => 'required|string|max:50',
            'seats'             => 'required|integer',
            'luggage'           => 'required|integer',
            'ac'                => 'required|boolean',
            'transmission'      => 'required|string|max:50',
            'price'             => 'required|numeric|min:0', // Basic car price
            'price_2_5_days'    => 'required|numeric|min:0',
            'price_6_10_days'   => 'required|numeric|min:0',
            'price_20_days'     => 'required|numeric|min:0',
            'pickup_location'   => 'required|string|max:255',
            'available'         => 'required|boolean',
            'franchise_price'   => 'nullable|numeric|min:0',
            'full_tank_price'   => 'nullable|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
            'season_prices'     => 'nullable|array',
            'season_prices.*.season_name'        => 'required_with:season_prices|string|max:100',
            'season_prices.*.start_date'         => 'required_with:season_prices|date',
            'season_prices.*.end_date'           => 'required_with:season_prices|date',
            'season_prices.*.price_2_5_days'     => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_6_20_days'    => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_20_plus_days' => 'required_with:season_prices|numeric|min:0',
        ]);

        $data = $request->all();
        $data['location'] = $data['pickup_location'];
                // تحويل حقل الموقع من pickup_location إلى location للتخزين في قاعدة البيانات
                if ($request->hasFile('image')) {
                    $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                    $request->file('image')->move(public_path('uploads/cars'), $imageName);
                    $data['image'] = 'uploads/cars/' . $imageName;
                }



        $car = new Car();
        $car->fill($data);
        $car->save();

        if ($request->has('season_prices')) {
            foreach ($request->season_prices as $seasonPriceData) {
                $car->seasonPrices()->create([
                    'season_name'       => $seasonPriceData['season_name'],
                    'start_date'        => $seasonPriceData['start_date'],
                    'end_date'          => $seasonPriceData['end_date'],
                    'price_2_5_days'    => $seasonPriceData['price_2_5_days'],
                    'price_6_20_days'   => $seasonPriceData['price_6_20_days'],
                    'price_20_plus_days'=> $seasonPriceData['price_20_plus_days'],
                    'franchise_price'   => $car->franchise_price,
                    'full_tank_price'   => $car->full_tank_price,
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    // Show the details of a specific car
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Show the form to edit car data
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Update car data
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
            'pickup_location'   => 'required|string|max:255',
            'available'         => 'required|boolean',
            'franchise_price'   => 'nullable|numeric|min:0',
            'full_tank_price'   => 'nullable|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
            'season_prices'     => 'nullable|array',
            'season_prices.*.season_name'        => 'required_with:season_prices|string|max:100',
            'season_prices.*.start_date'         => 'required_with:season_prices|date',
            'season_prices.*.end_date'           => 'required_with:season_prices|date',
            'season_prices.*.price_2_5_days'     => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_6_20_days'    => 'required_with:season_prices|numeric|min:0',
            'season_prices.*.price_20_plus_days' => 'required_with:season_prices|numeric|min:0',
        ]);

        $data = $request->all();
        $data['location'] = $data['pickup_location'];

     
        if ($request->hasFile('image')) {
            if ($car->image && file_exists(public_path($car->image))) {
                unlink(public_path($car->image));
            }
            
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/cars'), $imageName);
            $data['image'] = 'uploads/cars/' . $imageName;
        }



        $car->update($data);

        // حذف الأسعار القديمة وإدخال الجديدة
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
                    'franchise_price'   => $car->franchise_price,
                    'full_tank_price'   => $car->full_tank_price,
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    // Delete a car
    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Car::where('id', $id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }

    // Display all cars for use in reservations or general display
    public function allCars()
    {
        $cars = Car::all();
        return response()->json($cars);
    }
}
