<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/diam.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js for sidebar toggle -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <body class="font-sans antialiased text-gray-800">
    <div x-data="{ collapsed: false }" x-init="window.addEventListener('sidebar-collapsed', e => collapsed = e.detail)" class="min-h-screen bg-gray-100 flex">
      @include('layouts.navigation')
      <div :class="collapsed ? 'flex-1 lg:ml-20' : 'flex-1 lg:ml-56'" class="transition-all duration-300 flex flex-col w-0">
        <!-- Page Heading -->
        @isset($header)
          <header class="bg-white shadow w-full">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
              {{ $header }}
            </div>
          </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1 w-full overflow-x-auto">
          {{ $slot }}
        </main>
      </div>
    </div>
  </body>
</html>
