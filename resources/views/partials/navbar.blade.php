<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>صفحة مع لودينغ احترافي</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* تأثير نبضي للوغو */
    @keyframes pulseScale {
      0% { transform: scale(0.95); opacity: 0.8; }
      50% { transform: scale(1); opacity: 1; }
      100% { transform: scale(0.95); opacity: 0.8; }
    }
    .animate-pulse-scale {
      animation: pulseScale 1.5s ease-in-out infinite;
    }
    /* تأثير تلاشي عند إزالة شاشة اللودينغ */
    .fade-out {
      opacity: 0;
      transition: opacity 0.5s ease-out;
      pointer-events: none;
    }
  </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md">
        <div class="container px-0 py-2 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('assets/diam-logo.png') }}" alt="Logo" class="h-16 mr-2">
            </a>
    
            <div class="hidden lg:flex space-x-8">
                <a href="{{ route('home') }}" class="text-gray-800 hover:text-gray-600 transition duration-300">Home</a>
                <a href="{{ route('cars.index') }}" class="text-gray-800 hover:text-gray-600 transition duration-300">Admin</a>
            </div>
    
            <button id="navbar-toggler" aria-label="Toggle navigation" class="lg:hidden text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    
        <div id="navbarMenu" class="lg:hidden hidden">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Home</a>
            <a href="{{ route('cars.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Admin</a>
        </div>
    </nav>
  
  <!-- سكربت الجوال لتبديل القائمة وإخفاء شاشة اللودينغ -->
  <script>
    // تفعيل زر القائمة للجوال
    const navbarToggler = document.getElementById('navbar-toggler');
    const navbarMenu = document.getElementById('navbarMenu');
  
    navbarToggler.addEventListener('click', () => {
      navbarMenu.classList.toggle('hidden');
    });
  
  </script>
</body>
</html>
