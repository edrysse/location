<?php
namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarSeasonPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    // Display the list of cars to users
    public function index(Request $request)
    {
        // التحقق من جميع المواقع المتوفرة في قاعدة البيانات
        $allLocations = Car::distinct()->pluck('location')->toArray();

        $query = Car::query();

        if ($request->filled('location')) {

            $query->where('location', $request->location);
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

        $cars = $query->paginate(10);

        return view('cars', compact('cars'))
            ->with($request->only([
                'location', 'name', 'fuel', 'ac', 'transmission'
            ]));
    }
    public function availableCars()
    {
        // جلب السيارات المتاحة من قاعدة البيانات
        $cars = Car::all();

        // جلب المدن المتاحة
        $locations = Car::distinct()->pluck('location')->toArray();

        return view('cars.available_cars', compact('cars', 'locations'));
    }
    // Display the list of cars in the admin interface
    public function adminindex(Request $request)
    {
        $query = Car::query();

        if ($request->filled('location')) {
            $query->where('location', $request->location);
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

        $cars = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('cars.index', compact('cars'))
            ->with($request->only([
                'location', 'name', 'fuel', 'ac', 'transmission'
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
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'fuel' => 'required|string|max:255',
                'seats' => 'required|integer',
                'transmission' => 'required|string|max:255',
                'price' => 'required|numeric',
                'price_2_days' => 'required|numeric',
                'price_3_7_days' => 'required|numeric',
                'price_7_plus_days' => 'required|numeric',
                'franchise_price' => 'nullable|numeric',
                'rachat_franchise_price' => 'nullable|numeric',
                'location' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'season_prices.*.name' => 'nullable|string|max:255',
                'season_prices.*.start_date' => 'nullable|date',
                'season_prices.*.end_date' => 'nullable|date',
                'season_prices.*.price_2_days' => 'nullable|numeric',
                'season_prices.*.price_3_7_days' => 'nullable|numeric',
                'season_prices.*.price_7_plus_days' => 'nullable|numeric',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();

                // Create directory if it doesn't exist
                $uploadPath = public_path('images/cars');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $image->move($uploadPath, $imageName);
                $validatedData['image'] = 'images/cars/' . $imageName;
            }

            // Set default values
            $validatedData['available'] = true;
            $validatedData['kilometer'] = $request->input('kilometer', 0);

            // Create the car
            $car = Car::create($validatedData);

            // Create season prices if any
            if ($request->has('season_prices')) {
                foreach ($request->season_prices as $seasonData) {
                    if (!empty($seasonData['name']) && !empty($seasonData['start_date'])) {
                        $this->createSeasonPrice($car, $seasonData);
                    }
                }
            }

            return redirect()->route('admin.cars.index')->with('success', 'Car added successfully');
        } catch (\Exception $e) {
            \Log::error('Error creating car: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->withInput()->with('error', 'Error adding car: ' . $e->getMessage());
        }
    }

    protected function createSeasonPrice($car, $seasonData)
    {
        return $car->seasonPrices()->create([
            'name' => $seasonData['name'] ?? 'Default Season',
            'start_date' => $seasonData['start_date'],
            'end_date' => $seasonData['end_date'],
            'price_2_days' => $seasonData['price_2_days'],
            'price_3_7_days' => $seasonData['price_3_7_days'],
            'price_7_plus_days' => $seasonData['price_7_plus_days'],
        ]);
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
        try {
            $validationRules = [
                'name'              => 'required|string|max:255',
                'fuel'              => 'required|string|max:50',
                'seats'             => 'required|integer',
                'transmission'      => 'required|string|max:50',
                'price'             => 'required|numeric|min:0',
                'price_2_days'      => 'required|numeric|min:0',
                'price_3_7_days'    => 'required|numeric|min:0',
                'price_7_plus_days' => 'required|numeric|min:0',
                'kilometer'         => 'required|string',
                'location'          => 'required|string|max:255',
                'franchise_price'   => 'nullable|numeric|min:0',
                'rachat_franchise_price' => 'nullable|numeric|min:0',
                'available'         => 'required|boolean',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];

            if ($request->has('season_prices')) {
                $validationRules['season_prices.*.name'] = 'required|string|max:255';
                $validationRules['season_prices.*.start_date'] = 'required|date';
                $validationRules['season_prices.*.end_date'] = 'required|date|after_or_equal:season_prices.*.start_date';
                $validationRules['season_prices.*.price_2_days'] = 'required|numeric|min:0';
                $validationRules['season_prices.*.price_3_7_days'] = 'required|numeric|min:0';
                $validationRules['season_prices.*.price_7_plus_days'] = 'required|numeric|min:0';
            }

            $request->validate($validationRules);

            $data = $request->except(['image']);

            if ($request->hasFile('image')) {
                // Create uploads directory if it doesn't exist
                $uploadPath = public_path('uploads/cars');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Move the image to the uploads directory
                $image->move($uploadPath, $imageName);

                // Delete old image if exists
                if ($car->image && file_exists(public_path($car->image))) {
                    unlink(public_path($car->image));
                }

                // Store the relative path in the database
                $data['image'] = 'uploads/cars/' . $imageName;
            }

            // Update the car
            $car->update($data);

            // Update season prices if provided
            if ($request->has('season_prices')) {
                // Delete existing season prices
                $car->seasonPrices()->delete();

                // Create new season prices
                foreach ($request->season_prices as $seasonPriceData) {
                    if (!empty($seasonPriceData['name'])) {
                        $car->seasonPrices()->create([
                            'name' => $seasonPriceData['name'],
                            'start_date' => $seasonPriceData['start_date'],
                            'end_date' => $seasonPriceData['end_date'],
                            'price_2_days' => $seasonPriceData['price_2_days'],
                            'price_3_7_days' => $seasonPriceData['price_3_7_days'],
                            'price_7_plus_days' => $seasonPriceData['price_7_plus_days'],
                        ]);
                    }
                }
            }

            return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating car: ' . $e->getMessage());
        }
    }

    // Delete a car
    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Car::where('id', $id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully');
    }

    // Display all cars for use in reservations or general display
    public function allCars()
    {
        $cars = Car::all();
        return response()->json($cars);
    }
}
