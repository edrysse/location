<nav x-data="{ open: false, dropdownOpen: false }" class="shadow sticky top-0 z-50 border-b bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-black-900" />
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <ul class="flex space-x-4">
                        <li>
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('cars.index')" :active="request()->routeIs('cars.index')">Cars</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">Reservations</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">Contacts</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">Reviews</x-nav-link>
                        </li>
                        @can('viewAdminPages')
                        <li>
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Admin Dashboard</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">Manage Users</x-nav-link>
                        </li>
                        @endcan
                    </ul>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center">
                <div class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center px-3 py-2 text-white bg-gray-800 hover:bg-gray-700 rounded-md">
                        <span class="mr-2">{{ Auth::user()->name }}</span>
                        <svg class="h-5 w-5 fill-current transform transition-transform" :class="{'rotate-180': dropdownOpen}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" x-cloak @click.away="dropdownOpen = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-xl z-50">
                        <ul class="py-2">
                            <li>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-600 hover:text-white transition rounded-md">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-red-600 hover:text-white transition rounded-md">
                                        Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Hamburger Icon -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-blue-500 transition">Dashboard</a>
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-blue-500 transition">Home</a>
            <a href="{{ route('cars.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-blue-500 transition">Cars</a>
            <a href="{{ route('reservations.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-blue-500 transition">Reservations</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-blue-500 transition">Contacts</a>
            <a href="{{ route('reviews.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-blue-500 transition">Reviews</a>
            @can('viewAdminPages')
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-red-500 transition">Admin Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-black hover:bg-red-500 transition">Manage Users</a>
            @endcan
            
            <!-- Profile and Logout Links in Mobile Menu -->
            <div class=""> <!-- لضبط الزر في أقصى اليمين -->
                <button @click="dropdownOpen = !dropdownOpen" class="block w-full max-w-xs text-left px-3 py-2 rounded-md text-base font-medium text-white bg-gray-800 hover:text-black hover:bg-gray-600 transition">
                    {{ Auth::user()->name }}
                    <!-- أيقونة دروب داون -->
                    <span class="ml-2 inline-block transform transition-transform" :class="{'rotate-180': dropdownOpen}">
                        ▼
                    </span>
                </button>
            </div>
            <div x-show="dropdownOpen" x-cloak @click.away="dropdownOpen = false" x-transition class="bg-gray-700 py-2 rounded-md">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-blue-500">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-white hover:bg-red-500">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>