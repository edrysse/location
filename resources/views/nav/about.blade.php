<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('messages.about_us') }} - {{ __('messages.site_name') }}</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-red-50 to-red-100 min-h-screen">
    @include('partials.loader')
    @include('partials.navbar')
    @include('partials.up')

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-96" style="background-image: url('/assets/about.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto h-full flex flex-col justify-center items-center relative z-10 px-4">
      <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4 text-center">
        {{ __('messages.about_us') }}
      </h1>
      <p class="text-lg md:text-xl text-white text-center">
        {{ __('messages.about_us_intro') }}
      </p>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- صورة لمراكش (يمكن استبدال الرابط بصورة حقيقية) -->
      <div class="md:w-1/2">
        <img src="/assets/location-voiture-marrakech-aeroport.jpg" loading="lazy" alt="{{ __('messages.marrakech_airport_alt') }}" class="w-full h-auto rounded-lg shadow-lg">
      </div>
      <!-- المحتوى النصي -->
      <div class="md:w-1/2 text-center md:text-left">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
          {{ __('messages.airport_car_rental_title') }}
        </h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          {{ __('messages.airport_car_rental_text') }}
        </p>
      </div>
    </div>
  </section>

  <!-- Car Rental Options -->
  <section class="container mx-auto my-12 px-4 bg-gray-50 py-8 rounded-lg shadow-lg">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- المحتوى النصي -->
      <div class="md:w-1/2 text-center md:text-left order-2 md:order-1">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
          {{ __('messages.gueliz_car_rental_title') }}
        </h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          {{ __('messages.gueliz_car_rental_text') }}
        </p>
      </div>
      <!-- صورة لمراكش -->
      <div class="md:w-1/2 order-1 md:order-2">
        <img src="/assets/location-de-voiture-marrakech.jpg" loading="lazy" alt="{{ __('messages.gueliz_image_alt') }}" class="w-full h-auto rounded-lg shadow-lg">
      </div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- صورة لمراكش (مثلاً منظر ليلي أو مكان سياحي) -->
      <div class="md:w-1/2">
        <img src="/assets/diamantina-8.jpg" alt="{{ __('messages.book_car_image_alt') }}" loading="lazy" class="w-full h-auto rounded-lg shadow-lg">
      </div>
      <!-- المحتوى النصي مع زر الحجز -->
      <div class="md:w-1/2 text-center md:text-left">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
          {{ __('messages.book_your_car_title') }}
        </h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          {{ __('messages.book_your_car_text') }}
        </p>
        <div class="mt-6">
          <a href="/available-cars" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200">
            {{ __('messages.book_now') }}
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Who We Are Section -->
  <section class="container mx-auto my-12 px-4 bg-red-50 py-8 rounded-lg shadow-lg">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- المحتوى النصي -->
      <div class="md:w-1/2 text-center md:text-left">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
          {{ __('messages.who_we_are_title') }}
        </h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          {{ __('messages.who_we_are_text') }}
        </p>
      </div>
      <!-- صورة لمراكش (مثلاً لقطة لشخص يستمتع بالتجوال) -->
      <div class="md:w-1/2">
        <img src="/assets/diam1.jpg" alt="{{ __('messages.who_we_are_image_alt') }}" loading="lazy" class="w-full h-auto rounded-lg shadow-lg">
      </div>
    </div>
  </section>

  <!-- Our Values -->
  <section class="container mx-auto my-12 px-4">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
      {{ __('messages.our_values') }}
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-handshake text-red-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.value_trust_title') }}</h3>
        <p class="text-gray-600">{{ __('messages.value_trust_text') }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-car text-red-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.value_quality_title') }}</h3>
        <p class="text-gray-600">{{ __('messages.value_quality_text') }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-star text-red-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">{{ __('messages.value_customer_title') }}</h3>
        <p class="text-gray-600">{{ __('messages.value_customer_text') }}</p>
      </div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section class="container mx-auto my-12 px-4 text-center">
    <h2 class="text-3xl font-bold text-gray-800">
      {{ __('messages.get_in_touch') }}
    </h2>
    <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
      {{ __('messages.get_in_touch_text') }}
    </p>
    <div class="mt-6">
      <a href="/contact/create" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
        {{ __('messages.contact_us') }}
      </a>
    </div>
  </section>

  @include('partials.footer')
</body>
</html>
