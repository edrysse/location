<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.available_cars') }} | DiamntinaCar - {{ __('messages.book_now') }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS (for modal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Meta Tags -->
    <meta name="description" content="{{ __('messages.description') }}">
    <meta name="keywords" content="Car Rental, Rental Cars, DiamntinaCar">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://diamantinacar.com/available-cars">
    <meta property="og:title" content="{{ __('messages.available_cars') }} | DiamntinaCar - {{ __('messages.book_now') }}">
    <meta property="og:description" content="{{ __('messages.description') }}">
    <meta property="og:image" content="https://diamantinacar.com/assets/hero-section.jpg">
    <meta property="og:url" content="https://diamantinacar.com/available-cars">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('messages.available_cars') }} | DiamntinaCar - {{ __('messages.book_now') }}">
    <meta name="twitter:description" content="{{ __('messages.description') }}">
    <meta name="twitter:image" content="https://diamantinacar.com/assets/hero-section.jpg">
</head>
<body class="bg-gradient-to-r from-red-50 to-red-100 min-h-screen">
    @include('partials.loader')
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center " style="background-image: url('/assets/hero-section.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto h-full flex flex-col justify-center items-center relative z-10">
            <h1 class="text-5xl font-bold text-white mb-4">{{ __('messages.available_cars') }}</h1>
            <p class="text-xl text-white mb-6">{{ __('messages.find_best_cars') }}</p>
            <a href="#explore" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
                {{ __('messages.book_now') }}
            </a>
        </div>
    </section>

    <!-- Car Listing Section -->
    <section class="container mx-auto my-12 px-4"  id="explore">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            <i class="fas fa-car mr-2 text-red-500"></i>
            {{ __('messages.available_cars') }}
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($cars as $car)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
              @if ($car->image)
                <img src="{{ asset($car->image) }}" loading="lazy" class="w-full h-48 object-contain bg-white" style="object-position:center;" alt="{{ $car->name }}">
              @else
                <img src="default-car.jpg" alt="{{ __('messages.default_car') }}" class="w-full h-48 object-contain bg-white" style="object-position:center;">
              @endif
              <div class="p-6">
                <h5 class="text-xl font-bold text-gray-800 flex items-center mb-4">
                  <i class="fas fa-car-side text-red-500 mr-2"></i>
                  {{ $car->name }}
                </h5>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-600 text-sm">
                  <div class="flex items-center gap-2"><i class="fas fa-users text-red-500"></i><span>{{ __('messages.seats') }}: <span class="font-bold">{{ $car->seats }}</span></span></div>
                  <div class="flex items-center gap-2"><i class="fas fa-gas-pump text-yellow-600"></i><span>{{ __('messages.fuel') }}: <span class="font-bold">{{ $car->fuel }}</span></span></div>
<div class="flex items-center gap-2"><i class="fas fa-tachometer-alt text-blue-500"></i><span>{{ __('messages.kilometer') }}: <span class="font-bold">{{ $car->kilometer }}</span></span></div>
                  <div class="flex items-center gap-2"><i class="fas fa-gear text-blue-600"></i><span>{{ __('messages.transmission') }}: <span class="font-bold">{{ $car->transmission }}</span></span></div>
                  <div class="flex items-center gap-2"><i class="fas fa-door-open text-green-600"></i><span>{{ __('messages.doors') }}: <span class="font-bold">{{ $car->doors }}</span></span></div>
                  <div class="flex items-center gap-2"><i class="fas fa-suitcase text-purple-600"></i><span>{{ __('messages.bags') }}: <span class="font-bold">{{ $car->bags }}</span></span></div>
                </div>
                <div class="mt-4 bg-green-50 p-3 rounded-md text-center">
                  <p class="text-lg font-bold text-green-600"><i class="fas fa-dollar-sign mr-1"></i>{{ \App\Helpers\CurrencyHelper::formatPrice($car->price) }} / {{ __('messages.today') }}</p>
                </div>
                <div class="mt-4 flex flex-col gap-3 md:flex-row md:justify-between">
                  <button class="w-full md:w-auto bg-red-600 hover:bg-red-700 transition-colors text-white py-2 px-4 rounded-lg font-semibold text-base flex items-center justify-center gap-2 shadow-md" onclick="openModal({{ $car->id }}, this)" data-location="{{ $car->location }}">
                    <i class="fas fa-calendar-check"></i> {{ __('messages.book_now') }}
                  </button>
                  <a href="{{ route('cars.show', $car->id) }}" class="w-full md:w-auto bg-gray-200 hover:bg-gray-300 transition-colors text-gray-800 py-2 px-4 rounded-lg font-semibold text-base flex items-center justify-center gap-2 shadow-md border border-gray-300">
                    <i class="fas fa-info-circle"></i> {{ __('messages.view_details') }}
                  </a>
                </div>
              </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- نافذة الحجز (Modal) -->
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-red-600 text-white">
                    <h5 class="modal-title" id="reservationModalLabel">
                        <i class="fas fa-calendar-check mr-2"></i>
                        {{ __('messages.reservation_details') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('messages.close') }}"></button>
                </div>
                <div class="modal-body">
                    <form id="reservationForm" action="{{ route('reservations.confirm') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="car_id" id="car_id">
                        <!-- مكان الاستلام -->
                        <div>
                            <label for="modal_pickup_location" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                {{ __('messages.pickup_location') }}
                            </label>
                            <select name="pickup_location" id="modal_pickup_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
                                <option value="" disabled selected>{{ __('messages.select_pickup_location') }}</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- مكان التسليم -->
                        <div>
                            <label for="modal_dropoff_location" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                {{ __('messages.dropoff_location') }}
                            </label>
                            <select name="dropoff_location" id="modal_dropoff_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
                                <option value="" disabled selected>{{ __('messages.select_dropoff_location') }}</option>
                                <option value="Marrakech (Agence)">Marrakech (Agence)</option>
                                <option value="Marrakech medina">Marrakech medina</option>
                                <option value="Marrakech aéroport">Marrakech aéroport</option>

                            </select>
                        </div>
                        <!-- تاريخ الاستلام -->
                        <div>
                            <label for="modal_pickup_date" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ __('messages.pickup_date') }}
                            </label>
                            <input type="datetime-local" id="modal_pickup_date" name="pickup_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
                        </div>
                        <!-- تاريخ العودة -->
                        <div>
                            <label for="modal_return_date" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ __('messages.return_date') }}
                            </label>
                            <input type="datetime-local" id="modal_return_date" name="return_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
                        </div>
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                            <i class="fas fa-check mr-2"></i>
                            {{ __('messages.confirm_reservation') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    @include('partials.up')

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- دالة فتح النافذة -->
    <script>
        function formatDateTime(date) {
            const pad = (num) => num.toString().padStart(2, '0');
            return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
        }

        function openModal(carId, button) {
            // تعيين قيمة car_id في النموذج
            document.getElementById('car_id').value = carId;

            // قراءة موقع السيارة من الزر المُضغط
            const carLocation = button.getAttribute('data-location');

            // تعيين القيمة الافتراضية لمكان الاستلام
            const pickupLocationSelect = document.getElementById('modal_pickup_location');
            pickupLocationSelect.value = carLocation;

            // تعيين التواريخ الافتراضية
            const now = new Date();
            const twoDaysLater = new Date();
            twoDaysLater.setDate(now.getDate() + 2);
            document.getElementById("modal_pickup_date").value = formatDateTime(now);
            document.getElementById("modal_return_date").value = formatDateTime(twoDaysLater);

            // عرض النافذة
            var modal = new bootstrap.Modal(document.getElementById('reservationModal'));
            modal.show();
        }
    </script>
</body>
</html>
