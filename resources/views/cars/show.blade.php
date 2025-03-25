<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('messages.car_details') }} - {{ $car->name }}</title>

  <!-- Meta Description -->
  <meta name="description" content="{{ __('messages.car_details_desc', ['name' => $car->name]) }}">

  <!-- Meta Keywords -->
  <meta name="keywords" content="{{ __('messages.car_details_keywords', ['name' => $car->name]) }}">

  <!-- Robots -->
  <meta name="robots" content="index, follow">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://diamantinacar.com/cars/{{ $car->slug }}">

  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="{{ __('messages.car_details') }} - {{ $car->name }} | DiamantinaCar">
  <meta property="og:description" content="{{ __('messages.car_details_desc', ['name' => $car->name]) }}">
  <meta property="og:image" content="{{ $car->image ? asset('storage/' . $car->image) : asset('hero-section.jpg') }}">
  <meta property="og:url" content="https://diamantinacar.com/cars/{{ $car->slug }}">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ __('messages.car_details') }} - {{ $car->name }} | DiamantinaCar">
  <meta name="twitter:description" content="{{ __('messages.car_details_desc', ['name' => $car->name]) }}">
  <meta name="twitter:image" content="{{ $car->image ? asset('storage/' . $car->image) : asset('hero-section.jpg') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kurale&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap CSS (for modal) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
    @include('partials.loader')
    @include('partials.navbar')
    @include('partials.up')

  <!-- تفاصيل السيارة -->
  <div class="container mx-auto my-10 px-4">
    <div class="bg-white rounded-lg shadow p-6">
      <div class="flex flex-col md:flex-row items-center md:items-start">
        <!-- صورة السيارة -->
        <div class="w-full md:w-1/2">
          @if($car->image)
            <img src="{{ asset(  $car->image) }}" loading="lazy" alt="{{ $car->name }}" class="w-full h-auto object-cover rounded-lg">
          @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
              <span class="text-gray-500">{{ __('messages.no_image') }}</span>
            </div>
          @endif
        </div>
        <!-- تفاصيل السيارة -->
        <div class="w-full md:w-1/2 md:pl-8 mt-6 md:mt-0">
          <h2 class="text-3xl font-bold text-gray-800 mb-4" style="font-family: 'Kurale', cursive;">
            {{ $car->name }}
          </h2>
          <ul class="space-y-2 text-gray-600">
            <li><i class="fa-solid fa-gas-pump text-blue-500 mr-2"></i><span class="font-semibold">{{ __('messages.fuel_details') }}:</span> {{ $car->fuel }}</li>
            <li><i class="fa-solid fa-chair text-green-500 mr-2"></i><span class="font-semibold">{{ __('messages.seats_details') }}:</span> {{ $car->seats }}</li>
            <li><i class="fa-solid fa-suitcase-rolling text-purple-500 mr-2"></i><span class="font-semibold">{{ __('messages.luggage_details') }}:</span> {{ $car->luggage }}</li>
            <li><i class="fa-solid fa-snowflake text-blue-400 mr-2"></i><span class="font-semibold">{{ __('messages.ac_details') }}:</span> {{ $car->ac ? __('messages.yes') : __('messages.no') }}</li>
            <li><i class="fa-solid fa-gear text-gray-500 mr-2"></i><span class="font-semibold">{{ __('messages.transmission_details') }}:</span> {{ $car->transmission }}</li>
            <li><i class="fa-solid fa-map-marker-alt text-red-500 mr-2"></i><span class="font-semibold">{{ __('messages.location_details') }}:</span> {{ $car->location }}</li>
            <li><i class="fa-solid fa-dollar-sign text-yellow-500 mr-2"></i><span class="font-semibold">{{ __('messages.price_day') }}:</span> €{{ number_format($car->price, 2) }}</li>
            <li><i class="fa-solid fa-money-bill-wave text-yellow-500 mr-2"></i><span class="font-semibold">{{ __('messages.price_2_5_days') }}:</span> €{{ number_format($car->price_2_5_days, 2) }}</li>
            <li><i class="fa-solid fa-money-check-alt text-yellow-500 mr-2"></i><span class="font-semibold">{{ __('messages.price_6_10_days') }}:</span> €{{ number_format($car->price_6_10_days, 2) }}</li>
            <li><i class="fa-solid fa-hand-holding-dollar text-yellow-500 mr-2"></i><span class="font-semibold">{{ __('messages.price_20_days') }}:</span> €{{ number_format($car->price_20_days, 2) }}</li>
            <li>
              <i class="fa-solid fa-store-alt text-indigo-500 mr-2"></i>
              <span class="font-semibold">{{ __('messages.franchise_price') }}:</span>
              @if(isset($car->franchise_price))
                €{{ number_format($car->franchise_price, 2) }}
              @else
                {{ __('messages.not_applicable') }}
              @endif
            </li>
            <li>
              <i class="fa-solid fa-gas-pump text-indigo-500 mr-2"></i>
              <span class="font-semibold">{{ __('messages.full_tank_price') }}:</span>
              @if(isset($car->full_tank_price))
                €{{ number_format($car->full_tank_price, 2) }}
              @else
                {{ __('messages.not_applicable') }}
              @endif
            </li>
            <li><i class="fa-solid fa-check-circle text-green-500 mr-2"></i><span class="font-semibold">{{ __('messages.available') }}:</span> {{ $car->available ? __('messages.yes') : __('messages.no') }}</li>
          </ul>
        </div>
      </div>

      <!-- أسعار المواسم -->
      @if($car->seasonPrices && $car->seasonPrices->count())
      <div class="mt-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">
          <i class="fa-solid fa-calendar-alt text-blue-500 mr-2"></i>{{ __('messages.season_prices') }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($car->seasonPrices as $season)
            <div class="border rounded-lg p-4 bg-gray-50 shadow-sm">
              <div class="flex justify-between items-center mb-2">
                <span class="font-bold text-gray-800">
                  <i class="fa-solid fa-tag text-red-500 mr-1"></i>{{ $season->season_name }}
                </span>
                <span class="text-sm text-gray-600">
                  <i class="fa-solid fa-clock mr-1"></i>{{ date('Y-m-d', strtotime($season->start_date)) }} - {{ date('Y-m-d', strtotime($season->end_date)) }}
                </span>
              </div>
              <div class="text-gray-700 space-y-1">
                <p>
                  <i class="fa-solid fa-money-bill-wave text-yellow-500 mr-1"></i>
                  <span class="font-semibold">{{ __('messages.price_2_5_days') }}:</span> €{{ number_format($season->price_2_5_days, 2) }}
                </p>
                <p>
                  <i class="fa-solid fa-money-check-alt text-yellow-500 mr-1"></i>
                  <span class="font-semibold">{{ __('messages.price_6_10_days') }}:</span> €{{ number_format($season->price_6_20_days, 2) }}
                </p>
                <p>
                  <i class="fa-solid fa-hand-holding-dollar text-yellow-500 mr-1"></i>
                  <span class="font-semibold">{{ __('messages.price_20_days') }}:</span> €{{ number_format($season->price_20_plus_days, 2) }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      @endif

      <!-- أزرار الإجراءات -->
      <div class="mt-8 flex justify-between">
        <!-- زر الحجز -->
        <button id="openBookingModal" data-location="{{ $car->location }}" class="block bg-blue-600 hover:bg-blue-700 transition-colors text-white py-2 px-4 rounded-lg">
            {{ __('messages.book_now') }}
        </button>

        <!-- زر العودة -->
        <a href="{{ route('available.cars') }}" class="inline-block bg-gray-600 hover:bg-gray-700 transition-colors text-white py-2 px-4 rounded-lg">
          <i class="fa-solid fa-arrow-left mr-2"></i> {{ __('messages.back_to_car_list') }}
        </a>
      </div>
    </div>
  </div>

  <!-- Reservation Modal (Bootstrap Modal) -->
  <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header bg-blue-600 text-white">
                  <h5 class="modal-title" id="reservationModalLabel">
                      <i class="fas fa-calendar-check mr-2"></i>
                      {{ __('messages.reservation_details') }}
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('messages.close') }}"></button>
              </div>
              <div class="modal-body">
                  <form id="reservationForm" action="{{ route('reservations.confirm') }}" method="POST" class="space-y-4">
                      @csrf
                      <input type="hidden" name="car_id" id="car_id" value="{{ $car->id }}">
                      <!-- Pickup Location -->
                      <div>
                          <label for="modal_pickup_location" class="block text-gray-700 font-medium mb-2">
                              <i class="fas fa-map-marker-alt mr-1"></i>
                              {{ __('messages.pickup_location') }}
                          </label>
                          <select name="pickup_location" id="modal_pickup_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                              <option value="" disabled selected>{{ __('messages.select_pickup_location') }}</option>
                              <option value="Marrakech (Agence)">Marrakech (Agence)</option>
                              <option value="Marrakech medina">Marrakech medina</option>
                              <option value="Marrakech aéroport">Marrakech aéroport</option>
                              <option value="Essaouira">Essaouira</option>
                              <option value="Casablanca">Casablanca</option>
                              <option value="Mohammedia">Mohammedia</option>
                              <option value="Agadir">Agadir</option>
                              <option value="Ouarzazate">Ouarzazate</option>
                              <option value="Rabat">Rabat</option>
                              <option value="Tanger">Tanger</option>
                              <option value="Fès">Fès</option>
                          </select>
                      </div>
                      <!-- Drop-off Location -->
                      <div>
                          <label for="modal_dropoff_location" class="block text-gray-700 font-medium mb-2">
                              <i class="fas fa-map-marker-alt mr-1"></i>
                              {{ __('messages.dropoff_location') }}
                          </label>
                          <select name="dropoff_location" id="modal_dropoff_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                              <option value="" disabled selected>{{ __('messages.select_dropoff_location') }}</option>
                              <option value="Marrakech (Agence)">Marrakech (Agence)</option>
                              <option value="Marrakech medina">Marrakech medina</option>
                              <option value="Marrakech aéroport">Marrakech aéroport</option>
                              <option value="Essaouira">Essaouira</option>
                              <option value="Casablanca">Casablanca</option>
                              <option value="Mohammedia">Mohammedia</option>
                              <option value="Agadir">Agadir</option>
                              <option value="Ouarzazate">Ouarzazate</option>
                              <option value="Rabat">Rabat</option>
                              <option value="Tanger">Tanger</option>
                              <option value="Fès">Fès</option>
                          </select>
                      </div>
                      <!-- Pickup Date -->
                      <div>
                          <label for="modal_pickup_date" class="block text-gray-700 font-medium mb-2">
                              <i class="fas fa-calendar-alt mr-1"></i>
                              {{ __('messages.pickup_date') }}
                          </label>
                          <input type="datetime-local" id="modal_pickup_date" name="pickup_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                      </div>
                      <!-- Return Date -->
                      <div>
                          <label for="modal_return_date" class="block text-gray-700 font-medium mb-2">
                              <i class="fas fa-calendar-alt mr-1"></i>
                              {{ __('messages.return_date') }}
                          </label>
                          <input type="datetime-local" id="modal_return_date" name="return_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                      </div>
                      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                          <i class="fas fa-check mr-2"></i>
                          {{ __('messages.confirm_reservation') }}
                      </button>
                  </form>
              </div>
          </div>
      </div>
  </div>

  @include('partials.footer')

  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Modal Open Function -->
  <script>
    function formatDateTime(date) {
      const pad = (num) => num.toString().padStart(2, '0');
      return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
    }

    document.getElementById("openBookingModal").addEventListener("click", function(event) {
      event.preventDefault();

      // قراءة موقع السيارة من data attribute
      const carLocation = this.getAttribute("data-location");
      document.getElementById("modal_pickup_location").value = carLocation;

      // ضبط التواريخ الافتراضية
      const now = new Date();
      const twoDaysLater = new Date();
      twoDaysLater.setDate(now.getDate() + 2);
      document.getElementById("modal_pickup_date").value = formatDateTime(now);
      document.getElementById("modal_return_date").value = formatDateTime(twoDaysLater);

      // عرض المودال باستخدام Bootstrap Modal
      var modal = new bootstrap.Modal(document.getElementById('reservationModal'));
      modal.show();
    });
  </script>
</body>
</html>
