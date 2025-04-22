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
<body class="bg-gradient-to-r from-red-50 to-red-100 min-h-screen">
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

      <!-- PDF Download Button -->
      <div class="mt-8 animate-fadeInUp flex flex-col md:flex-row gap-4 justify-center">
        @php
          $locale = app()->getLocale();
          $termsPdfPath = 'pdfs/terms of conditions diamantinacar.pdf';
          $privacyPdfPath = 'pdfs/privacy policy diamantinacar.pdf';
        @endphp
        <a href="{{ asset($termsPdfPath) }}" target="_blank" class="inline-flex items-center px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full transition duration-300 transform hover:scale-105">
          <i class="fas fa-download mr-2"></i>
          {{ __('messages.download_terms_pdf') }}
        </a>
        <a href="{{ asset($privacyPdfPath) }}" target="_blank" class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition duration-300 transform hover:scale-105">
          <i class="fas fa-download mr-2"></i>
          {{ __('messages.download_privacy_pdf') }}
        </a>
      </div>
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
