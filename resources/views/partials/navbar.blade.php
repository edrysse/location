<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('messages.site_title') }}</title>
  <!-- Google Fonts: Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Flag Icon CSS from CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
  <style>
  body[dir="rtl"] {
    direction: rtl;
    text-align: right;
  }

  body[dir="rtl"] nav {
    flex-direction: row-reverse;
  }

  body[dir="rtl"] .flag-icon {
    margin-right: 0;
    margin-left: 8px;
  }

  body[dir="rtl"] .ml-2 {
    margin-left: 0 !important;
    margin-right: 0.5rem !important;
  }

  body[dir="rtl"] .mr-2 {
    margin-right: 0 !important;
    margin-left: 0.5rem !important;
  }

  body[dir="rtl"] .text-left {
    text-align: right !important;
  }

  body[dir="rtl"] .text-right {
    text-align: left !important;
  }

  body[dir="rtl"] .pl-4 {
    padding-left: 0 !important;
    padding-right: 1rem !important;
  }

  body[dir="rtl"] .pr-4 {
    padding-right: 0 !important;
    padding-left: 1rem !important;
  }
</style>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
  <!-- Navbar -->
  <nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4">
      <div class="flex items-center justify-between h-20">
        <!-- اللوجو -->
        <a href="{{ LaravelLocalization::localizeURL(route('home')) }}" class="flex-shrink-0">
          <img src="{{ asset('assets/diam-logo.png') }}" alt="{{ __('messages.site_logo_alt') }}" class="h-16">
        </a>
        <!-- قائمة التنقل الرئيسية للشاشات المكتبية -->
        <div class="hidden md:flex space-x-6 items-center">
          <a href="{{ LaravelLocalization::localizeURL(route('home')) }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.home') }}</a>
          <a href="{{ LaravelLocalization::localizeURL(route('available.cars')) }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.cars') }}</a>
          <a href="{{ LaravelLocalization::localizeURL(route('contact.create')) }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.contact') }}</a>
          <a href="{{ LaravelLocalization::localizeURL(route('nav.about')) }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.about') }}</a>
          <a href="{{ LaravelLocalization::localizeURL(route('nav.terms')) }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.terms_conditions') }}</a>

          <!-- زر تبديل اللغة (القائمة المنسدلة) -->
          <div class="relative inline-block text-left">
            <button type="button" id="language-menu-button" class="inline-flex justify-center items-center rounded-md border border-gray-300 shadow-sm px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" aria-expanded="false" aria-haspopup="true">
              <!-- استخدام flag-icon-css -->
              <span class="flag-icon flag-icon-{{ app()->getLocale() == 'ar' ? 'ma' : (app()->getLocale() == 'en' ? 'us' : app()->getLocale()) }} mr-2"></span>
              {{ LaravelLocalization::getCurrentLocaleNative() }}
              <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
              </svg>
            </button>
            <div id="language-dropdown" class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
              <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="language-menu-button">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  @if($localeCode != app()->getLocale())
                  <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                    <span class="flag-icon flag-icon-{{ $localeCode == 'ar' ? 'ma' : ($localeCode == 'en' ? 'us' : $localeCode) }} mr-2"></span>
                    {{ $properties['native'] }}
                  </a>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
          @auth
            <a href="{{ LaravelLocalization::localizeURL(route('dashboard')) }}" class="text-gray-800 hover:text-green-600 font-medium transition duration-300">{{ __('messages.dashboard') }}</a>
          @endauth
        </div>
        <!-- زر القائمة للجوال -->
        <div class="md:hidden flex items-center">
          <!-- زر تبديل اللغة للجوال -->
          <div class="mr-4 relative">
            <button type="button" id="mobile-language-button" class="inline-flex justify-center items-center w-10 h-10 rounded-full border border-gray-300 shadow-sm bg-white text-sm text-gray-700 hover:bg-gray-50 focus:outline-none" aria-expanded="false" aria-haspopup="true">
              <span class="flag-icon flag-icon-{{ app()->getLocale() == 'ar' ? 'ma' : (app()->getLocale() == 'en' ? 'us' : app()->getLocale()) }}"></span>
            </button>
            <div id="mobile-language-dropdown" class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
              <div class="py-1" role="menu" aria-orientation="vertical">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  @if($localeCode != app()->getLocale())
                  <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                    <span class="flag-icon flag-icon-{{ $localeCode == 'ar' ? 'ma' : ($localeCode == 'en' ? 'us' : $localeCode) }} mr-2"></span>
                    {{ $properties['native'] }}
                  </a>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
          <!-- زر القائمة الرئيسية للجوال -->
          <button id="mobile-menu-button" class="text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-600">
            <i class="fas fa-bars fa-2x"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- قائمة الجوال -->
    <div id="mobile-menu" class="md:hidden hidden">
      <div class="px-4 pt-2 pb-4 space-y-2 bg-white shadow-lg">
        <a href="{{ LaravelLocalization::localizeURL(route('home')) }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.home') }}</a>
        <a href="{{ LaravelLocalization::localizeURL(route('available.cars')) }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.cars') }}</a>
        <a href="{{ LaravelLocalization::localizeURL(route('contact.create')) }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.contact') }}</a>
        <a href="{{ LaravelLocalization::localizeURL(route('nav.about')) }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.about') }}</a>
        <a href="{{ LaravelLocalization::localizeURL(route('nav.terms')) }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ __('messages.terms_conditions') }}</a>
        @auth
          <a href="{{ LaravelLocalization::localizeURL(route('dashboard')) }}" class="block text-gray-800 hover:text-green-600 font-medium transition duration-300">{{ __('messages.dashboard') }}</a>
        @endauth
        <!-- قائمة تبديل اللغة للجوال -->
        <div class="pt-4 border-t border-gray-200">
          <p class="text-gray-600 text-sm mb-2">{{ __('messages.language') }}</p>
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if($localeCode != app()->getLocale())
            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">{{ $properties['native'] }}</a>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </nav>

  <!-- سكربت لتبديل القوائم المنسدلة -->
  <script>
    // القائمة المنسدلة للغة في نسخة سطح المكتب
    const languageButton = document.getElementById('language-menu-button');
    const languageDropdown = document.getElementById('language-dropdown');
    languageButton.addEventListener('click', (e) => {
      e.stopPropagation();
      languageDropdown.classList.toggle('hidden');
    });
    window.addEventListener('click', (e) => {
      if (!languageButton.contains(e.target) && !languageDropdown.contains(e.target)) {
        languageDropdown.classList.add('hidden');
      }
    });

    // القائمة المنسدلة للغة في نسخة الجوال
    const mobileLanguageButton = document.getElementById('mobile-language-button');
    const mobileLanguageDropdown = document.getElementById('mobile-language-dropdown');
    mobileLanguageButton.addEventListener('click', (e) => {
      e.stopPropagation();
      mobileLanguageDropdown.classList.toggle('hidden');
    });
    window.addEventListener('click', (e) => {
      if (!mobileLanguageButton.contains(e.target) && !mobileLanguageDropdown.contains(e.target)) {
        mobileLanguageDropdown.classList.add('hidden');
      }
    });

    // زر القائمة الرئيسية للجوال
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
