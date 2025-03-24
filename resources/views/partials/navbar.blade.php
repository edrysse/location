<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diamantina Car</title>
  <!-- Google Fonts: Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
  <!-- Navbar -->
  <nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4">
      <div class="flex items-center justify-between h-20">
        <!-- اللوجو -->
        <a href="{{ route('home') }}" class="flex-shrink-0">
          <img src="{{ asset('assets/diam-logo.png') }}" alt="Diamantina Car Logo" class="h-16">
        </a>
        <!-- قائمة التنقل للشاشات المكتبية -->
        <div class="hidden md:flex space-x-6">
          <a href="{{ route('home') }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">Home</a>
          <a href="{{ route('available.cars') }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">Cars</a>
          <a href="{{ route('contact.create') }}" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">Contact</a>
          <a href="{{ route('nav.about') }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">About</a>
        <a href="{{ route('nav.terms') }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">Terms & Conditions</a>
                <a class="nav-link" href="/en">English</a>
           
                <a class="nav-link" href="/ar">العربية</a>
        
                <a class="nav-link" href="/fr">Français</a>
         

          @auth
            <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-green-600 font-medium transition duration-300">Dashboard</a>

          @endauth
        </div>
        <!-- زر القائمة للجوال -->
        <div class="md:hidden">
          <button id="mobile-menu-button" class="text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-600">
            <i class="fas fa-bars fa-2x"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- قائمة الجوال -->
    <div id="mobile-menu" class="md:hidden hidden">
      <div class="px-4 pt-2 pb-4 space-y-2 bg-white shadow-lg">
        <a href="{{ route('home') }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">Home</a>
        <a href="{{ route('available.cars') }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">Cars</a>
        <a href="{{ route('contact.create') }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">Contact</a>
        <a href="{{ route('nav.about') }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">About</a>
        <a href="{{ route('nav.terms') }}" class="block text-gray-800 hover:text-blue-600 font-medium transition duration-300">Terms & Conditions</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('lang/en') }}">English</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('lang/ar') }}">العربية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('lang/fr') }}">Français</a>
            </li>
        </ul>

        @auth

          <a href="{{ route('dashboard') }}" class="block text-gray-800 hover:text-green-600 font-medium transition duration-300">Dashboard</a>

        @endauth
      </div>
    </div>
  </nav>


  <!-- سكربت تبديل القائمة على الجوال -->
  <script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
