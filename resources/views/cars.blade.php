<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('messages.available_cars_title') }}</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @include('partials.loader')

  @include('partials.navbar')
  @include('partials.up')

  <div class="container mx-auto mt-12 px-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">{{ __('messages.available_cars_heading') }}</h1>

    @if($cars->isEmpty())
      <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded text-center">
        <p>
          {{ __('messages.no_cars_message') }}
          <a href="/" class="underline font-bold">{{ __('messages.choose_another_location') }}</a>.
        </p>
      </div>
    @else
      <!-- Cars Grid with a modern card design -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($cars as $car)
          <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
            @if ($car->image)
              <img src="{{ asset($car->image) }}" class="w-full h-48 object-cover" alt="{{ $car->name }}">
            @else
              <img src="default-car.jpg" alt="{{ __('messages.default_car_alt') }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-6">
              <h5 class="text-xl font-bold text-gray-800 flex items-center mb-4">
                <i class="fas fa-car-side text-red-500 mr-2"></i>
                {{ $car->name }}
              </h5>
              <!-- Car Details -->
              <!-- تفاصيل السيارة -->
              <div class="grid grid-cols-2 gap-4 text-gray-600 text-sm">
                <div class="flex items-center">
                  <i class="fas fa-users mr-1"></i>
                  <span>{{ __('messages.seats') }}: {{ $car->seats }}</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-gas-pump mr-1"></i>
                  <span>{{ __('messages.fuel') }}: {{ $car->fuel }}</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-gear mr-1"></i>
                  <span>{{ __('messages.transmission') }}: {{ $car->transmission }}</span>
                </div>

                <div class="flex items-center">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  <span>{{ __('messages.location') }}: {{ $car->location }}</span>
                </div>
                <div class="flex items-center col-span-2">
                  <i class="fas fa-road mr-1"></i>
                  <span>{{ __('messages.kilometer') }}: {{ $car->kilometer }}</span>
                </div>
              </div>
              <!-- سعر الإيجار -->
              <div class="mt-4 bg-green-50 p-3 rounded-md text-center">
                <p class="text-lg font-bold text-green-600">
                  <i class="fas fa-dollar-sign mr-1"></i>
                  €{{ number_format($car->price, 2) }} / {{ __('messages.today') }}
                </p>
            </div>
              <!-- Buttons -->
              <div class="mt-4 flex flex-wrap gap-4">
                <!-- Book Now Button -->
                <a href="{{ route('reservations.create', [
                        'car_id' => $car->id,
                        'pickup_location' => request('pickup_location'),
                        'dropoff_location' => request('dropoff_location'),
                        'pickup_date' => request('pickup_date'),
                        'return_date' => request('return_date')
                    ]) }}"
                   class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 text-center">
                  {{ __('messages.book_now') }}
                </a>
                <!-- View Details Button -->
                <a href="{{ route('cars.show', $car->id) }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300 flex items-center">
                  <i class="fas fa-info-circle mr-2"></i>
                  {{ __('messages.view_details') }}
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    @endif
  </div>

  @include('partials.footer')
</body>
</html>
