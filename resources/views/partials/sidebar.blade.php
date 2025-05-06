<aside x-data="{ collapsed: false }" :class="collapsed ? 'w-20' : 'w-64'" class="transition-all duration-300 bg-gray-900 text-white h-screen fixed hidden md:block">
    <!-- زر التجميع -->
    <button @click="collapsed = !collapsed" class="absolute top-4 right-4 bg-gray-800 hover:bg-gray-700 rounded-full p-1 focus:outline-none transition" title="تجميع/توسيع">
      <svg x-show="!collapsed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" /></svg>
      <svg x-show="collapsed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
    </button>
    <div class="p-4 flex items-center justify-center border-b border-gray-700">
      <a href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/diam.png') }}" alt="Diamantina Car Logo" :class="(collapsed ? 'h-40' : 'h-48') + ' mx-auto transition-all duration-300 animate-pulse-scale'">
      </a>
    </div>
    <nav class="mt-4">
      <ul>
        <!-- Dashboard -->
        <li class="py-2 px-4 hover:bg-gray-700">
          <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
            <i class="fas fa-tachometer-alt text-lg"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- Manage Cars -->
        <li class="py-2 px-4 hover:bg-gray-700">
          <a href="{{ route('cars.index') }}" class="flex items-center space-x-3">
            <i class="fas fa-car text-lg"></i>
            <span>Manage Cars</span>
          </a>
        </li>
        <!-- Manage Reservations -->
        <li class="py-2 px-4 hover:bg-gray-700">
          <a href="{{ route('reservations.index') }}" class="flex items-center space-x-3">
            <i class="fas fa-calendar-check text-lg"></i>
            <span>Manage Reservations</span>
          </a>
        </li>
        <!-- Manage Reviews -->
        <li class="py-2 px-4 hover:bg-gray-700">
          <a href="{{ route('admin.reviews.index') }}" class="flex items-center space-x-3">
            <i class="fas fa-star text-lg"></i>
            <span>Manage Reviews</span>
          </a>
        </li>
        <!-- Contact Messages -->
        <li class="py-2 px-4 hover:bg-gray-700">
          <a href="{{ route('contact.index') }}" class="flex items-center space-x-3">
            <i class="fas fa-envelope text-lg"></i>
            <span>Contact Messages</span>
          </a>
        </li>
        <!-- Logout -->
        <li class="py-2 px-4 hover:bg-gray-700">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3">
              <i class="fas fa-sign-out-alt text-lg"></i>
              <span>Logout</span>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </aside>
