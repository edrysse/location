<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('messages.terms_conditions') }} - {{ __('messages.site_name') }}</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Tailwind Typography Plugin -->
  <script>
    tailwind.config = {
      theme: {
        extend: {},
      },
      plugins: [tailwindcssTypography],
    }
  </script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
    /* تنسيق للصور الدلالية */
    .section-icon {
      width: 40px;
      height: 40px;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
  @include('partials.navbar')
  @include('partials.up')

<!-- Hero Section -->
<section class="relative h-screen overflow-hidden">
    <!-- الخلفية مع تراكب تدرجي -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/assets/hero-section.jpg');"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/90"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
      <h1 class="text-5xl md:text-6xl font-extrabold text-white drop-shadow-2xl animate-fadeInDown">
        {{ __('messages.general_rental_conditions') }}
      </h1>
      <p class="mt-6 text-lg md:text-xl text-gray-200 max-w-2xl animate-fadeInUp">
        {{ __('messages.terms_conditions_intro') }}
      </p>
    </div>
  </section>
  
  <!-- Content Section -->
  <section class="container mx-auto my-16 px-4">
    <div class="grid gap-12 md:grid-cols-2">
      <!-- بطاقة القسم 1: Make Your Reservation -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/reserve.jpg" alt="{{ __('messages.reserve_alt') }}">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-calendar-check text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.make_reservation') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
    {!! __('messages.make_reservation_text') !!}
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 2: Use of the Car -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/uses.jpg" alt="{{ __('messages.use_car_alt') }}">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-car-side text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.use_car') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            {{ __('messages.use_car_text') }}
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 3: Condition & Liability -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/terms.jpg" alt="{{ __('messages.condition_liability_alt') }}">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-clipboard-list text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.condition_liability') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            {{ __('messages.condition_liability_text') }}
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 4: Delivery / Collection -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/delevry.jpg" alt="{{ __('messages.delivery_collection_alt') }}">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-truck text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.delivery_collection') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            {{ __('messages.delivery_collection_text') }}
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 5: Fuel Policy -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/fuel.jpg" alt="{{ __('messages.fuel_policy_alt') }}">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-gas-pump text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.fuel_policy') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            {{ __('messages.fuel_policy_text') }}
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 6: Insurance -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/insurance.jpg" alt="{{ __('messages.insurance_alt') }}">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-shield-alt text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.insurance') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            {{ __('messages.insurance_text') }}
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 7: Assistance -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/accident.jpg" alt="{{ __('messages.assistance_alt') }}">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-wrench text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.assistance') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            {{ __('messages.assistance_text') }}
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 8: Payment / Deposit -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/payment.jpg" alt="{{ __('messages.payment_deposit_alt') }}">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-credit-card text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('messages.payment_deposit') }}</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            {{ __('messages.payment_deposit_text') }}
          </p>
        </div>
      </article>
    </div>
  </section>
  
  <!-- Custom Animations -->
  <style>
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInDown {
      animation: fadeInDown 1s ease-out;
    }
    .animate-fadeInUp {
      animation: fadeInUp 1s ease-out;
    }
  </style>
  
  @include('partials.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
