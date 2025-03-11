<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Car</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

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
  <!-- Main Container -->
  <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
    <!-- Header Section -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-gray-900 text-center">Edit Car</h1>
      <p class="text-center text-gray-600 mt-2">Update the details of your car below</p>
    </div>

    <!-- Edit Car Form -->
    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      <!-- Grid Form Fields -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Car Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-car-side mr-1"></i>Car Name
          </label>
          <input type="text" name="name" id="name" value="{{ $car->name }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

    <!-- Price -->
<div>
    <label for="price" class="block text-sm font-medium text-gray-700">
      <i class="fas fa-dollar-sign mr-1"></i> Price
    </label>
    <input type="number" step="0.01" name="price" id="price" value="{{ $car->price }}" required
           class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
  </div>
      
        <!-- Fuel Type -->
        <div>
          <label for="fuel" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-gas-pump mr-1"></i>Fuel Type
          </label>
          <input type="text" name="fuel" id="fuel" value="{{ $car->fuel }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Seats -->
        <div>
          <label for="seats" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-users mr-1"></i>Seats
          </label>
          <input type="number" name="seats" id="seats" value="{{ $car->seats }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Luggage Capacity -->
        <div>
          <label for="luggage" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-suitcase-rolling mr-1"></i>Luggage Capacity
          </label>
          <input type="number" name="luggage" id="luggage" value="{{ $car->luggage }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Air Conditioning -->
        <div>
          <label for="ac" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-wind mr-1"></i>Air Conditioning
          </label>
          <select name="ac" id="ac" required
                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="1" {{ $car->ac ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$car->ac ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <!-- Transmission -->
        <div>
          <label for="transmission" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-exchange-alt mr-1"></i>Transmission
          </label>
          <input type="text" name="transmission" id="transmission" value="{{ $car->transmission }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Price (2-5 Days) -->
        <div>
          <label for="price_2_5_days" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-clock mr-1"></i>Price (2-5 Days)
          </label>
          <input type="number" step="0.01" name="price_2_5_days" id="price_2_5_days" value="{{ $car->price_2_5_days }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Price (6-10 Days) -->
        <div>
          <label for="price_6_10_days" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-clock mr-1"></i>Price (6-10 Days)
          </label>
          <input type="number" step="0.01" name="price_6_10_days" id="price_6_10_days" value="{{ $car->price_6_10_days }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Price (20+ Days) -->
        <div>
          <label for="price_20_days" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-clock mr-1"></i>Price (20+ Days)
          </label>
          <input type="number" step="0.01" name="price_20_days" id="price_20_days" value="{{ $car->price_20_days }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
            <!-- Location -->
            <div class="flex-1">
                <label for="location" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-map-marker-alt mr-1"></i> Location
                </label>
                <input type="text" name="location" id="location" value="{{ $car->location }}" required
                       class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        
            <!-- Available -->
            <div class="flex-1">
                <label for="available" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-check-circle mr-1"></i> Available
                </label>
                <select name="available" id="available" required
                        class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ $car->available ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$car->available ? 'selected' : '' }}>No</option>
                </select>
            </div>
        

        <!-- Car Image (full width on small screens) -->
        <div class="sm:col-span-2">
          <label for="image" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-image mr-1"></i>Car Image
          </label>
          <input type="file" name="image" id="image"
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          @if ($car->image)
            <div class="mt-4 flex items-center space-x-4">
              <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="rounded-lg w-40 h-40 object-cover shadow-md">
              <span class="text-gray-500 text-sm">Current Image</span>
            </div>
          @endif
        </div>
      </div>

      <!-- Submit Button -->
      <div class="mt-8 flex justify-end">
        <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
          <i class="fas fa-save mr-2"></i>
          Update Car
        </button>
      </div>
    </form>
  </div>

  @include('partials.footer')
</body>
</html>
