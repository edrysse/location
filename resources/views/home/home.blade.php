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
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap" rel="stylesheet">

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
    [data-aos] { opacity: 0; transform: translateY(40px); transition: all 0.7s cubic-bezier(.77,0,.18,1); }
    .aos-animate { opacity: 1 !important; transform: none !important; }
  </style>
</head>
<body class="bg-gradient-to-r from-red-50 to-red-100 min-h-screen">
  {{-- Loader & Navbar --}}
  @include('partials.loader')
  @include('partials.navbar')
  @include('partials.up')

  {{-- 1. Reservation Form Section with Background Image and Welcome Text --}}
  <section id="reservation" class="relative bg-cover bg-center py-20" style="background-image: url('/assets/bg-diam.png');" data-aos>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto relative z-10 px-4 pt-12" data-aos>
      <h2 class="text-4xl  text-white text-center mb-8 uppercase" style="text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);font-family: 'Playfair Display', serif;" data-aos>{{ __('messages.welcome_diamantina') }}</h2>
      <div class="bg-white bg-opacity-90 rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
        <h3 class="text-3xl font-bold text-center mb-6 text-gray-800">
          <i class="fas fa-calendar-check mr-2 text-red-500"></i>
          {{ __('messages.make_reservation') }}
        </h3>
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
    </div>
  </section>

  {{-- 2. Car Listing Section --}}
  <section class="container mx-auto my-12 px-4" data-aos>
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8" data-aos>
      <i class="fas fa-car mr-2 text-red-500"></i>
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
              <button class="w-full md:w-auto bg-red-600 hover:bg-red-700 transition-colors text-white py-3 px-4 rounded-lg font-bold text-lg flex items-center justify-center gap-2 shadow-md" onclick="myUniqueOpenModal({{ $car->id }}, this)" data-location="{{ $car->location }}">
                <i class="fas fa-calendar-check"></i> {{ __('messages.book_now') }}
              </button>
              <a href="{{ route('cars.show', $car->id) }}" class="w-full md:w-auto bg-gray-200 hover:bg-gray-300 transition-colors text-gray-800 py-3 px-4 rounded-lg font-bold text-lg flex items-center justify-center gap-2 shadow-md border border-gray-300">
                <i class="fas fa-info-circle"></i> {{ __('messages.view_details') }}
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="text-center mt-8">
      <a href="{{ LaravelLocalization::localizeURL(route('available.cars')) }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
        <i class="fas fa-car mr-2"></i>
        {{ __('messages.view_all_cars') }}
      </a>
    </div>
  </section>

  {{-- 3. Why Choose Us Section --}}
  <section class="container mx-auto my-12 px-4" data-aos>
    <div class="text-center mb-8" data-aos>
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

  {{-- 4. FAQ / Have Questions Section --}}
  <section class="container mx-auto my-12 px-4" data-aos>
    <div class="text-center mb-8" data-aos>
      <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.have_questions') }}</h2>
      <p class="text-gray-600 mt-2">{{ __('messages.faqs_description') }}</p>
    </div>
    <div class="space-y-4 w-[90%] mx-auto">
      @for($i = 1; $i <= 6; $i++)
        <div class="bg-white p-2 md:p-3 rounded-lg shadow-lg">
          <button class="w-full text-left flex justify-between items-center focus:outline-none min-h-[1.8rem] md:min-h-[2.2rem]" onclick="toggleFAQ(this)">
            <h3 class="text-lg font-semibold text-gray-800 whitespace-normal break-words leading-tight">{{ __('messages.faq_question_'.$i) }}</h3>
            <i class="fas fa-chevron-down text-red-500 transition-transform duration-200"></i>
          </button>
          <div class="faq-content mt-2 overflow-hidden transition-all duration-300 max-h-0">
            <p class="text-gray-600">{!! __('messages.faq_answer_'.$i) !!}</p>
          </div>
        </div>
      @endfor
    </div>
  </section>

  {{-- 5. Testimonials Section --}}
  <section class="container mx-auto my-12 px-4" data-aos>
    <div class="text-center mb-8" data-aos>
      <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.customer_testimonials') }}</h2>
      <p class="text-gray-600 mt-2">{{ __('messages.hear_from_customers') }}</p>
    </div>
    <div id="testimonialSwiper" class="swiper-container relative">
      <div class="swiper-wrapper" id="testimonial-wrapper">
        @foreach($reviews as $review)
        <div class="swiper-slide testimonial-card">
          <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="testimonial-content">
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
        </div>
        @endforeach
      </div>
      <div class="swiper-button-next text-red-500"></div>
      <div class="swiper-button-prev text-red-500"></div>
      <div class="swiper-pagination text-red-500"></div>
    </div>
    <script>
      // توحيد ارتفاع جميع البطاقات بناءً على أكبر ريفيو
      document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function() {
          var testimonialCards = document.querySelectorAll('.testimonial-content');
          var maxHeight = 0;
          testimonialCards.forEach(function(card) {
            card.style.height = 'auto'; // reset first
            if(card.offsetHeight > maxHeight) maxHeight = card.offsetHeight;
          });
          testimonialCards.forEach(function(card) {
            card.style.height = maxHeight + 'px';
          });
        }, 500); // بعد التحميل بوقت بسيط لضمان ظهور كل العناصر
      });
    </script>
  </section>
<!-- Visit Us -->
<section class="container mx-auto my-12 px-4" data-aos>
  <div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-6" data-aos>
      <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.visit_us') }}</h2>
      <p class="text-gray-600 mt-2">{{ __('messages.our_agency_location') }}</p>
    </div>
    <div class="w-full aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-md" data-aos>
      <!-- Google Map -->
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.495678933812!2d-8.018646684800267!3d31.63467438133661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdafeefb5e3c3b1b%3A0x6a1c7a6e2e1b1e3c!2sDiamantina%20Car%20Location!5e0!3m2!1sfr!2sma!4v1683383838383!5m2!1sfr!2sma"
        width="100%" height="100%" style="border:0; min-height:350px;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

  {{-- Cookie Consent Banner --}}
  <div id="cookieConsentBanner" class="fixed bottom-0 left-0 w-full bg-black bg-opacity-80 text-white py-4 px-6 flex flex-col sm:flex-row items-center justify-between z-50 transition-all duration-300" style="display:none;">
    <div class="mb-2 sm:mb-0">
      <span>{{ __('messages.cookie_message') }}</span>
    </div>
    <div class="flex gap-2">
      <button onclick="acceptCookies()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">{{ __('messages.accept_cookies') }}</button>
      <button onclick="rejectCookies()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">{{ __('messages.reject_cookies') }}</button>
    </div>
  </div>
  <script>
    function setCookie(name, value, days) {
      let expires = "";
      if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    function getCookie(name) {
      const nameEQ = name + "=";
      const ca = document.cookie.split(';');
      for(let i=0;i < ca.length;i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
    }
    function acceptCookies() {
      setCookie('cookie_consent', 'accepted', 365);
      document.getElementById('cookieConsentBanner').style.display = 'none';
    }
    function rejectCookies() {
      setCookie('cookie_consent', 'rejected', 365);
      document.getElementById('cookieConsentBanner').style.display = 'none';
    }
    // Set language cookie on language change
    document.addEventListener('DOMContentLoaded', function() {
      var locale = '{{ app()->getLocale() }}';
      setCookie('site_language', locale, 365);
      if (!getCookie('cookie_consent')) {
        document.getElementById('cookieConsentBanner').style.display = 'flex';
      }
    });
  </script>

  {{-- Reservation Modal --}}
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

  {{-- Swiper JS --}}
  <script src="https://unpkg.com/swiper@8.4.5/swiper-bundle.min.js"></script>
  <script src="/assets/aos.js"></script>
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
        if (c !== content && !c.classList.contains('max-h-0')) {
          c.style.maxHeight = '0';
          c.previousElementSibling.querySelector('i').classList.remove('rotate-180');
        }
      });
      content.style.maxHeight = content.style.maxHeight ? null : content.scrollHeight + 'px';
      icon.classList.toggle('rotate-180');
    }
  </script>
  <script>
    // --- إعادة التوجيه حسب كوكي اللغة فقط عند أول زيارة (لا يعيد التوجيه بعد تغيير اللغة حتى تغلق المتصفح) ---
    (function() {
      function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i=0;i < ca.length;i++) {
          let c = ca[i];
          while (c.charAt(0)==' ') c = c.substring(1,c.length);
          if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
      }
      // استخدم sessionStorage لمنع التوجيه إلا عند أول زيارة فقط
      if(!sessionStorage.getItem('lang_redirected')) {
        var supportedLocales = ['ar','en','fr'];
        var cookieLang = getCookie('site_language');
        var currentPath = window.location.pathname;
        var currentLocale = currentPath.split('/')[1];
        if(cookieLang && supportedLocales.includes(cookieLang) && currentLocale !== cookieLang) {
          var newUrl = window.location.origin + '/' + cookieLang + window.location.pathname.substr(currentLocale.length+1) + window.location.search + window.location.hash;
          sessionStorage.setItem('lang_redirected', '1');
          window.location.replace(newUrl);
        }
      }
    })();
    // عند تغيير اللغة، حدّث الكوكيز فقط ولا تعيد التوجيه
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.change-language-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
          var lang = this.getAttribute('data-lang');
          document.cookie = 'site_language=' + lang + '; path=/; max-age=' + (365*24*60*60);
        });
      });
    });
  </script>
  <script>
    AOS.init();
  </script>
</body>
</html>
