<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Available Cars</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

  <div class="container mx-auto mt-12 px-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">Available Cars</h1>
    
    @if($cars->isEmpty())
      <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded text-center">
        <p>
          There are no cars available in the selected location.
          Please <a href="/" class="underline font-bold">choose another location</a>.
        </p>
      </div>
    @else
      <!-- Cars Grid with a modern card design -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($cars as $car)
          <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-500 hover:scale-105">
            <!-- Car Image with Dark Gradient Overlay and Daily Price Badge -->
            <div class="relative">
              @if ($car->image)
                <img src="{{ asset('storage/' . $car->image) }}" class="w-full h-56 object-cover" alt="{{ $car->name }}">
              @else
                <img src="default-car.jpg" class="w-full h-56 object-cover" alt="Default Car">
              @endif
              <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
              <div class="absolute bottom-0 left-0 p-4">
                <h3 class="text-xl font-bold text-white">{{ $car->name }}</h3>
                <p class="text-sm text-white">Daily Price: ${{ $car->price }} / day</p>
              </div>
            </div>
            <!-- Car Details -->
            <div class="p-4">
              <!-- Specifications -->
              <div class="flex flex-wrap gap-2 text-gray-600 text-sm mb-4">
                <div class="flex items-center space-x-1">
                  <i class="fas fa-snowflake"></i>
                  <span>AC: {{ $car->ac ? 'Yes' : 'No' }}</span>
                </div>
                <div class="flex items-center space-x-1">
                  <i class="fas fa-gas-pump"></i>
                  <span>Fuel: {{ $car->fuel }}</span>
                </div>
                <div class="flex items-center space-x-1">
                  <i class="fas fa-users"></i>
                  <span>Seats: {{ $car->seats }}</span>
                </div>
                <div class="flex items-center space-x-1">
                  <i class="fas fa-suitcase-rolling"></i>
                  <span>Luggage: {{ $car->luggage }}</span>
                </div>
                <div class="flex items-center space-x-1">
                  <i class="fas fa-cogs"></i>
                  <span>Transmission: {{ $car->transmission }}</span>
                </div>
                <div class="flex items-center space-x-1">
                  <i class="fas fa-map-marker-alt"></i>
                  <span>{{ $car->location }}</span>
                </div>
              </div>
              <!-- Professional Pricing Cards for Durations -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                @if($car->price_2_5_days)
                  <div class="bg-gray-50 p-3 rounded-lg text-center border border-gray-200">
                    <p class="text-xs text-gray-600">2-5 Days</p>
                    <p class="mt-1 text-lg font-semibold text-green-700">
                      <i class="fas fa-dollar-sign mr-1"></i>${{ $car->price_2_5_days }}/day
                    </p>
                  </div>
                @endif
                @if($car->price_6_10_days)
                  <div class="bg-gray-50 p-3 rounded-lg text-center border border-gray-200">
                    <p class="text-xs text-gray-600">6-10 Days</p>
                    <p class="mt-1 text-lg font-semibold text-green-700">
                      <i class="fas fa-dollar-sign mr-1"></i>${{ $car->price_6_10_days }}/day
                    </p>
                  </div>
                @endif
                @if($car->price_20_days)
                  <div class="bg-gray-50 p-3 rounded-lg text-center border border-gray-200">
                    <p class="text-xs text-gray-600">20+ Days</p>
                    <p class="mt-1 text-lg font-semibold text-green-700">
                      <i class="fas fa-dollar-sign mr-1"></i>${{ $car->price_20_days }}/day
                    </p>
                  </div>
                @endif
              </div>
              <!-- Book Now Button -->
              <a href="{{ route('reservations.create', [
                      'car_id' => $car->id,
                      'pickup_location' => request('pickup_location'),
                      'dropoff_location' => request('dropoff_location'),
                      'pickup_date' => request('pickup_date'),
                      'return_date' => request('return_date')
                  ]) }}"
                 class="block text-center bg-blue-600 hover:bg-blue-700 transition-colors text-white py-2 rounded">
                Book Now
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  @include('partials.footer')
</body>
</html>
