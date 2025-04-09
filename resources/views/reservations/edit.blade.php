<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Reservation</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  <x-app-layout>
    @include('partials.up')

    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
      <!-- Header Section -->
      <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900">Edit Reservation</h1>
        <p class="text-gray-600 mt-2">Update the details of your reservation below</p>
      </div>

      <!-- Success & Error Messages -->
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
          <strong>Success!</strong> {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <strong>Errors:</strong>
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Edit Reservation Form -->
      <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="space-y-6" id="reservationForm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Car Selection -->
          <div>
            <label for="car_id" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-car-side mr-1"></i> Car
            </label>
            <select name="car_id" id="car_id" required class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
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

          <!-- Pickup Location -->
          <div>
            <label for="pickup_location" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-map-marker-alt mr-1"></i> Pickup Location
            </label>
            <input type="text" name="pickup_location" id="pickup_location" value="{{ old('pickup_location', $reservation->pickup_location) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('pickup_location')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Dropoff Location -->
          <div>
            <label for="dropoff_location" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-map-marker-alt mr-1"></i> Dropoff Location
            </label>
            <input type="text" name="dropoff_location" id="dropoff_location" value="{{ old('dropoff_location', $reservation->dropoff_location) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('dropoff_location')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Pickup Date -->
          <div>
            <label for="pickup_date" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-calendar-alt mr-1"></i> Pickup Date
            </label>
            <input type="date" name="pickup_date" id="pickup_date" value="{{ old('pickup_date', \Carbon\Carbon::parse($reservation->pickup_date)->format('Y-m-d')) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('pickup_date')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Return Date -->
          <div>
            <label for="return_date" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-calendar-alt mr-1"></i> Return Date
            </label>
            <input type="date" name="return_date" id="return_date" value="{{ old('return_date', \Carbon\Carbon::parse($reservation->return_date)->format('Y-m-d')) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('return_date')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Customer Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-user mr-1"></i> Name
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $reservation->name) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('name')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-envelope mr-1"></i> Email
            </label>
            <input type="email" name="email" id="email" value="{{ old('email', $reservation->email) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('email')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Phone -->
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-phone mr-1"></i> Phone
            </label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $reservation->phone) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('phone')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Payment Status -->
          <div>
            <label for="payment_status" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-credit-card mr-1"></i> Payment Status
            </label>
            <select name="payment_status" id="payment_status" required
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
              <option value="Pending" {{ old('payment_status', $reservation->payment_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
              <option value="Paid" {{ old('payment_status', $reservation->payment_status) == 'Paid' ? 'selected' : '' }}>Paid</option>
            </select>
            @error('payment_status')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Payment Method -->
          <div>
            <label for="payment_method" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-money-check-alt mr-1"></i> Payment Method
            </label>
            <select name="payment_method" id="payment_method"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
              <option value="Credit Card" {{ old('payment_method', $reservation->payment_method) == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
              <option value="Cash" {{ old('payment_method', $reservation->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
              <option value="PayPal" {{ old('payment_method', $reservation->payment_method) == 'PayPal' ? 'selected' : '' }}>PayPal</option>
            </select>
            @error('payment_method')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- GPS -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              <i class="fas fa-map-marker-alt mr-1"></i> GPS ($1/Day)
            </label>
            <div class="mt-2 flex items-center space-x-4">
              <label class="inline-flex items-center">
                <input type="radio" name="gps" value="1" {{ old('gps', $reservation->gps) == 1 ? 'checked' : '' }} class="form-radio">
                <span class="ml-2">Yes</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="gps" value="0" {{ old('gps', $reservation->gps) == 0 ? 'checked' : '' }} class="form-radio">
                <span class="ml-2">No</span>
              </label>
            </div>
            @error('gps')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Maxicosi -->
          <div>
            <label for="maxicosi" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-child mr-1"></i> Maxicosi
            </label>
            <select name="maxicosi" id="maxicosi" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
              <option value="0" {{ old('maxicosi', $reservation->maxicosi) == 0 ? 'selected' : '' }}>0</option>
              <option value="1" {{ old('maxicosi', $reservation->maxicosi) == 1 ? 'selected' : '' }}>1</option>
              <option value="2" {{ old('maxicosi', $reservation->maxicosi) == 2 ? 'selected' : '' }}>2</option>
            </select>
            @error('maxicosi')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Child Seat (Siege Bebe) -->
          <div>
            <label for="siege_bebe" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-child mr-1"></i> Child Seat
            </label>
            <select name="siege_bebe" id="siege_bebe" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
              <option value="0" {{ old('siege_bebe', $reservation->siege_bebe) == 0 ? 'selected' : '' }}>0</option>
              <option value="1" {{ old('siege_bebe', $reservation->siege_bebe) == 1 ? 'selected' : '' }}>1</option>
              <option value="2" {{ old('siege_bebe', $reservation->siege_bebe) == 2 ? 'selected' : '' }}>2</option>
            </select>
            @error('siege_bebe')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Booster Seat (Rehausseur) -->
          <div>
            <label for="rehausseur" class="block text-sm font-medium text-gray-700">
              <i class="fas fa-child mr-1"></i> Booster Seat
            </label>
            <select name="rehausseur" id="rehausseur" class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
              <option value="0" {{ old('rehausseur', $reservation->rehausseur) == 0 ? 'selected' : '' }}>0</option>
              <option value="1" {{ old('rehausseur', $reservation->rehausseur) == 1 ? 'selected' : '' }}>1</option>
              <option value="2" {{ old('rehausseur', $reservation->rehausseur) == 2 ? 'selected' : '' }}>2</option>
            </select>
            @error('rehausseur')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Full Tank -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              <i class="fas fa-gas-pump mr-1"></i> Full Tank ($60)
            </label>
            <div class="mt-2 flex items-center space-x-4">
              <label class="inline-flex items-center">
                <input type="radio" name="full_tank" value="1" {{ old('full_tank', $reservation->full_tank) == 1 ? 'checked' : '' }} class="form-radio">
                <span class="ml-2">Yes</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="full_tank" value="0" {{ old('full_tank', $reservation->full_tank) == 0 ? 'checked' : '' }} class="form-radio">
                <span class="ml-2">No</span>
              </label>
            </div>
            @error('full_tank')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>

          <!-- Franchise -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              <i class="fas fa-shield-alt mr-1"></i> Franchise ($6/Day)
            </label>
            <div class="mt-2 flex items-center space-x-4">
              <label class="inline-flex items-center">
                <input type="radio" name="franchise" value="1" {{ old('franchise', $reservation->franchise) == 1 ? 'checked' : '' }} class="form-radio">
                <span class="ml-2">Yes</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="franchise" value="0" {{ old('franchise', $reservation->franchise) == 0 ? 'checked' : '' }} class="form-radio">
                <span class="ml-2">No</span>
              </label>
            </div>
            @error('franchise')
              <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-8 flex justify-center">
          <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
            <i class="fas fa-save mr-2"></i> Update Reservation
          </button>
        </div>
      </form>
    </div>

    @include('partials.footer')
  </x-app-layout>
</body>
</html>
