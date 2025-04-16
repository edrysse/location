<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('messages.title') }}</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@8.4.5/swiper-bundle.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      overflow-x: hidden;
      max-width: 100vw;
    }
    .swiper-slide {
      flex-shrink: 0;
    }
    @media (max-width: 768px) {
      .testimonial-card {
        min-width: 100%;
      }
    }
    .container {
      overflow: hidden;
      padding: 0 1rem;
    }
    img, video, iframe {
      max-width: 100%;
      height: auto;
    }
    .grid-cols-2 {
      grid-template-columns: 1fr;
    }
    .myModal-overlay {
      background-color: rgba(0, 0, 0, 0.5);
    }
    .faq-content {
      transition: all 0.3s ease-in-out;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-red-50 to-red-100 min-h-screen">
  {{-- أجزاء الموقع الرئيسية --}}
  @include('partials.loader')
  @include('partials.navbar')
  @include('partials.up')

  <!-- Hero Section -->
  <section class="relative bg-cover bg-center h-96" style="background-image: url('/assets/hero2.png');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto h-full flex flex-col justify-center items-center relative z-10">
      <h1 class="text-5xl font-bold text-white mb-4">{{ __('messages.welcome') }}</h1>
      <p class="text-xl text-white mb-6">{{ __('messages.best_service') }}</p>
      <a href="#reservation" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
        {{ __('messages.book_now') }}
      </a>
    </div>
  </section>

  <!-- Why Choose Us -->
  <section class="container mx-auto my-12 px-4">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.why_choose_us') }}</h2>
        <p class="text-gray-600 mt-2">{{ __('messages.best_service_description') }}</p>
      </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-truck-moving text-red-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.free_delivery') }}</h3>
        <p class="text-gray-600">{{ __('messages.free_delivery_description') }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-dollar-sign text-red-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.affordable_prices') }}</h3>
        <p class="text-gray-600">{{ __('messages.affordable_prices_description') }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-headset text-red-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.have_questions') }}</h3>
        <p class="text-gray-600">{{ __('messages.support_description') }}</p>
      </div>
    </div>
  </section>

  <!-- Reservation Form -->
  <section id="reservation" class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <h2 class="text-3xl font-bold text-center mb-6">
        <i class="fas fa-calendar-check mr-2 text-red-500"></i>
        {{ __('messages.make_reservation') }}
      </h2>
      <form action="{{ LaravelLocalization::localizeURL(route('cars')) }}" method="GET">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label for="pickup_location" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-map-marker-alt mr-1"></i>
              {{ __('messages.pickup_location') }}
            </label>
            <select name="pickup_location" id="pickup_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
              <option value="" disabled selected>{{ __('messages.select_pickup_location') }}</option>
              <option value="Marrakech (Agence)">Marrakech (Agence)</option>
              <option value="Marrakech medina">Marrakech medina</option>
              <option value="Marrakech aéroport">Marrakech aéroport</option>
            </select>
          </div>
          <div>
            <label for="dropoff_location" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-map-marker-alt mr-1"></i>
              {{ __('messages.dropoff_location') }}
            </label>
            <select name="dropoff_location" id="dropoff_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
              <option value="" disabled selected>{{ __('messages.select_dropoff_location') }}</option>
              <option value="Marrakech (Agence)">Marrakech (Agence)</option>
              <option value="Marrakech medina">Marrakech medina</option>
              <option value="Marrakech aéroport">Marrakech aéroport</option>
            </select>
          </div>
          <div>
            <label for="pickup_date" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-calendar-alt mr-1"></i>
              {{ __('messages.pickup_date') }}
            </label>
            <input type="datetime-local" id="pickup_date" name="pickup_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
          </div>
          <div>
            <label for="return_date" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-calendar-alt mr-1"></i>
              {{ __('messages.return_date') }}
            </label>
            <input type="datetime-local" id="return_date" name="return_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
          </div>
        </div>
        <div class="text-center mt-6">
          <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
            <i class="fas fa-search mr-2"></i>
            {{ __('messages.find_cars') }}
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Car Listing -->
  <section class="container mx-auto my-12 px-4">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
      <i class="fas fa-car mr-2 text-red-500"></i>
      {{ __('messages.view_all_cars') }}
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
            <i class="fas fa-car-side text-red-500 mr-2"></i>
            {{ $car->name }}
          </h5>
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
          <div class="mt-4 bg-green-50 p-3 rounded-md text-center">
            <p class="text-lg font-bold text-green-600">
              <i class="fas fa-dollar-sign mr-1"></i>
              €{{ number_format($car->price, 2) }} / {{ __('messages.today') }}
            </p>
          </div>
          <div class="mt-4 flex flex-wrap gap-4">
            <button class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 flex-1"
                    onclick="myUniqueOpenModal({{ $car->id }}, this)" data-location="{{ $car->location }}">
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
      <a href="{{ LaravelLocalization::localizeURL(route('cars')) }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
        <i class="fas fa-car mr-2"></i>
        {{ __('messages.view_all_cars') }}
      </a>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.customer_testimonials') }}</h2>
      <p class="text-gray-600 mt-2">{{ __('messages.hear_from_customers') }}</p>
    </div>
    <div id="testimonialSwiper" class="swiper-container relative">
      <div class="swiper-wrapper">
        @foreach($reviews as $review)
        <div class="swiper-slide testimonial-card">
          <div class="bg-white p-6 rounded-lg shadow-lg">
            <p class="text-gray-600 italic mb-4">"{{ $review->comment }}"</p>
            <div class="flex items-center space-x-4">
              @if($review->avatar)
              <img src="{{ asset($review->avatar) }}" loading="lazy" class="w-16 h-16 rounded-full object-cover" alt="{{ __('messages.customer') }}">
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
      <div class="swiper-button-next text-red-500"></div>
      <div class="swiper-button-prev text-red-500"></div>
      <div class="swiper-pagination text-red-500"></div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.have_questions') }}</h2>
      <p class="text-gray-600 mt-2">{{ __('messages.faqs_description') }}</p>
    </div>
    <div class="space-y-4">
      @for($i = 1; $i <= 6; $i++)
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <button class="w-full text-left flex justify-between items-center focus:outline-none"
                onclick="toggleFAQ(this)">
          <h3 class="text-lg font-semibold text-gray-800">
            {{ __('messages.faq_question_'.$i) }}
          </h3>
          <i class="fas fa-chevron-down text-red-500 transition-transform duration-200"></i>
        </button>
        <div class="faq-content mt-4 overflow-hidden transition-all duration-300 max-h-0">
          <p class="text-gray-600">
            {!! __('messages.faq_answer_'.$i) !!}
          </p>
        </div>
      </div>
      @endfor
    </div>
  </section>

  <!-- Contact Us -->
  <section class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.contact_us') }}</h2>
        <p class="text-gray-600 mt-2">{{ __('messages.questions_contact') }}</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-phone mr-2 text-red-600"></i>
            {{ __('messages.phone') }}
          </h3>
          <p class="text-gray-600">06.61.06.03.62 | 06.60.56.57.30</p>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-envelope mr-2 text-red-600"></i>
            {{ __('messages.email') }}
          </h3>
          <p class="text-gray-600">contact@diamantinacar.com</p>
        </div>
        <div class="md:col-span-2">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>
            {{ __('messages.address_title') }}
          </h3>
          <p class="text-gray-600">
            Angle Avenue 11 Janvier & Rue, Bd Prince Moulay Abdellah, Marrakech 40000
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Reservation Modal -->
  <div id="myUniqueReservationModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="myModal-overlay absolute inset-0"></div>
    <div class="bg-white rounded-lg shadow-lg z-10 w-11/12 max-w-md p-6 relative">
      <div class="flex justify-between items-center border-b pb-3">
        <h3 class="text-xl font-bold text-red-600">
          <i class="fas fa-calendar-check mr-2"></i>
          {{ __('messages.reservation_details') }}
        </h3>
        <button onclick="myUniqueCloseModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form id="myUniqueReservationForm" action="{{ LaravelLocalization::localizeURL(route('reservations.confirm')) }}" method="POST" class="space-y-4 mt-4">
        @csrf
        <input type="hidden" name="car_id" id="myUniqueCarId">
        <div>
          <label for="myUniqueModalPickupLocation" class="block text-gray-700 font-medium mb-2">
            <i class="fas fa-map-marker-alt mr-1"></i>
            {{ __('messages.pickup_location') }}
          </label>
          <select name="pickup_location" id="myUniqueModalPickupLocation" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
            <option value="" disabled selected>{{ __('messages.select_pickup_location') }}</option>
            <option value="Marrakech (Agence)">Marrakech (Agence)</option>
            <option value="Marrakech medina">Marrakech medina</option>
            <option value="Marrakech aéroport">Marrakech aéroport</option>
          </select>
        </div>
        <div>
          <label for="myUniqueModalDropoffLocation" class="block text-gray-700 font-medium mb-2">
            <i class="fas fa-map-marker-alt mr-1"></i>
            {{ __('messages.dropoff_location') }}
          </label>
          <select name="dropoff_location" id="myUniqueModalDropoffLocation" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
            <option value="" disabled selected>{{ __('messages.select_dropoff_location') }}</option>
            <option value="Marrakech (Agence)">Marrakech (Agence)</option>
            <option value="Marrakech medina">Marrakech medina</option>
            <option value="Marrakech aéroport">Marrakech aéroport</option>
          </select>
        </div>
        <div>
          <label for="myUniqueModalPickupDate" class="block text-gray-700 font-medium mb-2">
            <i class="fas fa-calendar-alt mr-1"></i>
            {{ __('messages.pickup_date') }}
          </label>
          <input type="datetime-local" id="myUniqueModalPickupDate" name="pickup_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
        </div>
        <div>
          <label for="myUniqueModalReturnDate" class="block text-gray-700 font-medium mb-2">
            <i class="fas fa-calendar-alt mr-1"></i>
            {{ __('messages.return_date') }}
          </label>
          <input type="datetime-local" id="myUniqueModalReturnDate" name="return_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-red-500" required>
        </div>
        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg transition duration-200">
          <i class="fas fa-check mr-2"></i>
          {{ __('messages.confirm_reservation') }}
        </button>
      </form>
    </div>
  </div>

  @include('partials.footer')

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper@8.4.5/swiper-bundle.min.js"></script>
  <script>
    function myUniqueFormatDateTime(date) {
      const pad = num => num.toString().padStart(2, '0');
      return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
    }

    function myUniqueOpenModal(carId, buttonElement) {
      document.getElementById('myUniqueCarId').value = carId;
      const carLocation = buttonElement.getAttribute('data-location');
      document.getElementById('myUniqueModalPickupLocation').value = carLocation;
      const now = new Date();
      const twoDaysLater = new Date();
      twoDaysLater.setDate(now.getDate() + 2);
      document.getElementById("myUniqueModalPickupDate").value = myUniqueFormatDateTime(now);
      document.getElementById("myUniqueModalReturnDate").value = myUniqueFormatDateTime(twoDaysLater);
      document.getElementById('myUniqueReservationModal').classList.remove('hidden');
    }

    function myUniqueCloseModal() {
      document.getElementById('myUniqueReservationModal').classList.add('hidden');
    }

    document.addEventListener("DOMContentLoaded", function() {
      const now = new Date();
      const twoDaysLater = new Date();
      twoDaysLater.setDate(now.getDate() + 2);
      document.getElementById("pickup_date").value = myUniqueFormatDateTime(now);
      document.getElementById("return_date").value = myUniqueFormatDateTime(twoDaysLater);
    });

    var testimonialSwiper = new Swiper('#testimonialSwiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        }
      }
    });

    function toggleFAQ(element) {
      const content = element.nextElementSibling;
      const icon = element.querySelector('i');
      document.querySelectorAll('.faq-content').forEach(c => {
        if(c !== content && !c.classList.contains('max-h-0')) {
          c.style.maxHeight = '0';
          c.previousElementSibling.querySelector('i').classList.remove('rotate-180');
        }
      });
      content.style.maxHeight = content.style.maxHeight ? null : content.scrollHeight + 'px';
      icon.classList.toggle('rotate-180');
    }
  </script>
</body>
</html>
