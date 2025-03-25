<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('messages.title') }}</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap CSS (للمودال) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@8.4.5/swiper-bundle.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      overflow-x: hidden;
    }
    /* المزيد من التنسيق حسب الحاجة */
  </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
  @include('partials.loader')
  @include('partials.navbar')
  @include('partials.up')

  <!-- Hero Section -->
  <section class="relative bg-cover bg-center h-96" style="background-image: url('/assets/hero-section.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto h-full flex flex-col justify-center items-center relative z-10">
      <h1 class="text-5xl font-bold text-white mb-4">{{ __('messages.welcome') }}</h1>
      <p class="text-xl text-white mb-6">{{ __('messages.best_service') }}</p>
      <a href="#reservation" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
        {{ __('messages.book_now') }}
      </a>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.why_choose_us') }}</h2>
      <p class="text-gray-600 mt-2">{{ __('messages.best_service_description') }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-truck-moving text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.free_delivery') }}</h3>
        <p class="text-gray-600">{{ __('messages.free_delivery_description') }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-dollar-sign text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.affordable_prices') }}</h3>
        <p class="text-gray-600">{{ __('messages.affordable_prices_description') }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-headset text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.support') }}</h3>
        <p class="text-gray-600">{{ __('messages.support_description') }}</p>
      </div>
    </div>
  </section>

  <!-- Reservation Form Section -->
  <section id="reservation" class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <h2 class="text-3xl font-bold text-center mb-6">
        <i class="fas fa-calendar-check mr-2 text-blue-500"></i>
        {{ __('messages.make_reservation') }}
      </h2>

      <form action="{{ LaravelLocalization::localizeURL(route('cars') )}}" method="GET">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Pickup Location -->
          <div>
            <label for="pickup_location" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-map-marker-alt mr-1"></i>
              {{ __('messages.pickup_location') }}
            </label>
            <select name="pickup_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
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
            <label for="dropoff_location" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-map-marker-alt mr-1"></i>
              {{ __('messages.dropoff_location') }}
            </label>
            <select name="dropoff_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
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
            <label for="pickup_date" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-calendar-alt mr-1"></i>
              {{ __('messages.pickup_date') }}
            </label>
            <input type="datetime-local" id="pickup_date" name="pickup_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
          </div>
          <!-- Return Date -->
          <div>
            <label for="return_date" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-calendar-alt mr-1"></i>
              {{ __('messages.return_date') }}
            </label>
            <input type="datetime-local" id="return_date" name="return_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
          </div>
        </div>
        <div class="text-center mt-6">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
            <i class="fas fa-search mr-2"></i>
            {{ __('messages.find_cars') }}
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Car Listing Section -->
  <section class="container mx-auto my-12 px-4">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
      <i class="fas fa-car mr-2 text-blue-500"></i>
      {{ __('messages.our_cars') }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      @foreach ($cars->take(3) as $car)
      <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
        @if ($car->image)
          <img src="{{ asset($car->image) }}" loading="lazy" class="w-full h-48 object-cover" alt="{{ $car->name }}">
        @else
          <img src="default-car.jpg" alt="{{ __('messages.default_car') }}" class="w-full h-48 object-cover">
        @endif
        <div class="p-6">
          <h5 class="text-xl font-bold text-gray-800 flex items-center mb-4">
            <i class="fas fa-car-side text-blue-500 mr-2"></i>
            {{ $car->name }}
          </h5>
          <!-- Car Details -->
          <div class="grid grid-cols-2 gap-4 text-gray-600 text-sm">
            <div class="flex items-center">
              <i class="fas fa-snowflake mr-1"></i>
              <span>{{ __('messages.ac') }}: {{ $car->ac ? __('messages.yes') : __('messages.no') }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-gas-pump mr-1"></i>
              <span>{{ __('messages.fuel') }}: {{ $car->fuel }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-users mr-1"></i>
              <span>{{ __('messages.seats') }}: {{ $car->seats }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-suitcase-rolling mr-1"></i>
              <span>{{ __('messages.luggage') }}: {{ $car->luggage }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-cogs mr-1"></i>
              <span>{{ __('messages.transmission') }}: {{ $car->transmission }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-map-marker-alt mr-1"></i>
              <span>{{ __('messages.location') }}: {{ $car->location }}</span>
            </div>
          </div>
          <!-- Price Per Day -->
          <div class="mt-4 bg-green-50 p-3 rounded-md text-center">
            <p class="text-lg font-bold text-green-600">
              <i class="fas fa-dollar-sign mr-1"></i>
              €{{ $car->price }} / {{ __('messages.day') }}
            </p>
          </div>
          <!-- Buttons -->
          <div class="mt-4 flex flex-wrap gap-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 flex-1"
                    onclick="openModal({{ $car->id }}, this)" data-location="{{ $car->location }}">
              {{ __('messages.book_now') }}
            </button>
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
    <div class="text-center mt-8">

        <a href="{{ LaravelLocalization::localizeURL(route('available.cars')) }}"  class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
        {{ __('messages.view_all_cars') }}
      </a>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.testimonials') }}</h2>
      <p class="text-gray-600 mt-2">{{ __('messages.happy_customers') }}</p>
    </div>
    <div id="testimonialSwiper" class="swiper-container relative">
      <div class="swiper-wrapper">
        @foreach($reviews as $review)
        <div class="swiper-slide">
          <div class="bg-white p-6 rounded-lg shadow-lg">
            <p class="text-gray-600 italic mb-4">"{{ $review->comment }}"</p>
            <div class="flex items-center space-x-4">
              @if($review->avatar)
              <img src="{{ asset( $review->avatar) }}" loading="lazy" class="w-16 h-16 rounded-full object-cover" alt="{{ __('messages.customer') }}">
              @else
              <img src="https://via.placeholder.com/50" class="w-16 h-16 rounded-full object-cover" alt="{{ __('messages.customer') }}">
              @endif
              <div>
                <p class="font-bold text-gray-800">{{ $review->name }}</p>
                <p class="text-gray-600 text-sm">{{ $review->position }}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.contact_us') }}</h2>
        <p class="text-gray-600 mt-2">{{ __('messages.contact_question') }}</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-phone mr-2 text-blue-600"></i>
            {{ __('messages.phone') }}
          </h3>
          <p class="text-gray-600">06.61.06.03.62 | 06.60.56.57.30</p>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-envelope mr-2 text-blue-600"></i>
            {{ __('messages.email') }}
          </h3>
          <p class="text-gray-600">contact@diamantinacar.com</p>
        </div>
        <div class="md:col-span-2">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
            {{ __('messages.address') }}
          </h3>
          <p class="text-gray-600">Angle Avenue 11 Janvier & Rue, Bd Prince Moulay Abdellah, Marrakech 40000</p>
        </div>
      </div>
    </div>
  </section>

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
          <form id="reservationForm" action="{{ LaravelLocalization::localizeURL(route('reservations.confirm') )}}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="car_id" id="car_id">
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
  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper@8.4.5/swiper-bundle.min.js"></script>

  <script>
    function formatDateTime(date) {
      const pad = (num) => num.toString().padStart(2, '0');
      return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
    }

    function openModal(carId, button) {
      document.getElementById('car_id').value = carId;
      const carLocation = button.getAttribute('data-location');
      document.getElementById('modal_pickup_location').value = carLocation;
      const now = new Date();
      const twoDaysLater = new Date();
      twoDaysLater.setDate(now.getDate() + 2);
      document.getElementById("modal_pickup_date").value = formatDateTime(now);
      document.getElementById("modal_return_date").value = formatDateTime(twoDaysLater);
      var modal = new bootstrap.Modal(document.getElementById('reservationModal'));
      modal.show();
    }

    // Initialize Swiper for Testimonials Section only
    var testimonialSwiper = new Swiper('#testimonialSwiper', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      pagination: {
        el: '#testimonialSwiper .swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '#testimonialSwiper .swiper-button-next',
        prevEl: '#testimonialSwiper .swiper-button-prev',
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        }
      }
    });
  </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
          function formatDateTime(date) {
            const pad = (num) => num.toString().padStart(2, '0');
            return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
          }
          const now = new Date();
          const twoDaysLater = new Date();
          twoDaysLater.setDate(now.getDate() + 2);
          document.getElementById("pickup_date").value = formatDateTime(now);
          document.getElementById("return_date").value = formatDateTime(twoDaysLater);
        });
      </script>
</body>
</html>
