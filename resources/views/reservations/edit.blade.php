<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

@include('partials.navbar')

<div class="container mx-auto mt-10">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Edit Reservation</h1>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <!-- Car Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="car_id">Car</label>
            <select name="car_id" id="car_id" required class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select a car</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}" {{ old('car_id', $reservation->car_id) == $car->id ? 'selected' : '' }}>
                        {{ $car->name }}
                    </option>
                @endforeach
            </select>
            @error('car_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pickup/Dropoff Locations -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="pickup_location">Pickup Location</label>
            <input type="text" name="pickup_location" value="{{ old('pickup_location', $reservation->pickup_location) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            @error('pickup_location')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="dropoff_location">Dropoff Location</label>
            <input type="text" name="dropoff_location" value="{{ old('dropoff_location', $reservation->dropoff_location) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            @error('dropoff_location')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Dates -->
  
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="pickup_date">Pickup Date</label>
            <input type="date" name="pickup_date" id="pickup_date" value="{{ old('pickup_date', \Carbon\Carbon::parse($reservation->pickup_date)->format('Y-m-d')) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('pickup_date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="return_date">Return Date</label>
            <input type="date" name="return_date" id="return_date" value="{{ old('return_date', \Carbon\Carbon::parse($reservation->return_date)->format('Y-m-d')) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('return_date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>


        <!-- Personal Info -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
            <input type="text" name="name" value="{{ old('name', $reservation->name) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $reservation->email) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $reservation->phone) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            @error('phone')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Payment Status -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="payment_status">Payment Status</label>
            <select name="payment_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <option value="Paid" {{ old('payment_status', $reservation->payment_status) == 'Paid' ? 'selected' : '' }}>Paid</option>
                <option value="Pending" {{ old('payment_status', $reservation->payment_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
            </select>
            @error('payment_status')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Payment Method -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="payment_method">Payment Method</label>
            <select name="payment_method" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <option value="Credit Card" {{ old('payment_method', $reservation->payment_method) == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                <option value="Cash" {{ old('payment_method', $reservation->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="PayPal" {{ old('payment_method', $reservation->payment_method) == 'PayPal' ? 'selected' : '' }}>PayPal</option>
            </select>
            @error('payment_method')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- GPS -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">GPS ($1/Day)</label>
            <div class="flex items-center">
                <input type="radio" name="gps" value="1" {{ old('gps', $reservation->gps) == 1 ? 'checked' : '' }}>
                <label class="ml-2">Yes</label>
            </div>
            <div class="flex items-center mt-2">
                <input type="radio" name="gps" value="0" {{ old('gps', $reservation->gps) == 0 ? 'checked' : '' }}>
                <label class="ml-2">No</label>
            </div>
            @error('gps')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Maxicosi -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="maxicosi">Maxicosi</label>
            <select name="maxicosi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <option value="0" {{ old('maxicosi', $reservation->maxicosi) == 0 ? 'selected' : '' }}>0</option>
                <option value="1" {{ old('maxicosi', $reservation->maxicosi) == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('maxicosi', $reservation->maxicosi) == 2 ? 'selected' : '' }}>2</option>
            </select>
            @error('maxicosi')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Child Seat (Siege Bebe) -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="siege_bebe">Child Seat</label>
            <select name="siege_bebe" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <option value="0" {{ old('siege_bebe', $reservation->siege_bebe) == 0 ? 'selected' : '' }}>0</option>
                <option value="1" {{ old('siege_bebe', $reservation->siege_bebe) == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('siege_bebe', $reservation->siege_bebe) == 2 ? 'selected' : '' }}>2</option>
            </select>
            @error('siege_bebe')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Booster Seat (Rehausseur) -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="rehausseur">Booster Seat</label>
            <select name="rehausseur" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <option value="0" {{ old('rehausseur', $reservation->rehausseur) == 0 ? 'selected' : '' }}>0</option>
                <option value="1" {{ old('rehausseur', $reservation->rehausseur) == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('rehausseur', $reservation->rehausseur) == 2 ? 'selected' : '' }}>2</option>
            </select>
            @error('rehausseur')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Full Tank -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Full Tank ($60)</label>
            <div class="flex items-center">
                <input type="radio" name="full_tank" value="1" {{ old('full_tank', $reservation->full_tank) == 1 ? 'checked' : '' }}>
                <label class="ml-2">Yes</label>
            </div>
            <div class="flex items-center mt-2">
                <input type="radio" name="full_tank" value="0" {{ old('full_tank', $reservation->full_tank) == 0 ? 'checked' : '' }}>
                <label class="ml-2">No</label>
            </div>
            @error('full_tank')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Franchise -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Franchise ($6/Day)</label>
            <div class="flex items-center">
                <input type="radio" name="franchise" value="1" {{ old('franchise', $reservation->franchise) == 1 ? 'checked' : '' }}>
                <label class="ml-2">Yes</label>
            </div>
            <div class="flex items-center mt-2">
                <input type="radio" name="franchise" value="0" {{ old('franchise', $reservation->franchise) == 0 ? 'checked' : '' }}>
                <label class="ml-2">No</label>
            </div>
            @error('franchise')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Reservation
            </button>
        </div>
    </form>
</div>

@include('partials.footer')

</body>
</html>