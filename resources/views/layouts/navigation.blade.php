<nav x-data="{ open: false }" class="shadow sticky top-0 z-50 border-b bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-black-900" />
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <ul class="flex space-x-4">
                     
                        <li>
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-blue-500 transition">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-blue-500 transition">
                                {{ __('Home') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('cars.index')" :active="request()->routeIs('cars.index')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-blue-500 transition">
                                {{ __('Cars') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-blue-500 transition">
                                {{ __('Reservations') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-blue-500 transition">
                                {{ __('Contacts') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-blue-500 transition">
                                {{ __('Reviews') }}
                            </x-nav-link>
                        </li>
                        @can('viewAdminPages')
                            <li>
                                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-red-500 transition">
                                    {{ __('Admin Dashboard') }}
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-black hover:bg-red-500 transition">
                                    {{ __('Manage Users') }}
                                </x-nav-link>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center">
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center px-3 py-2 text-white bg-gray-800 hover:bg-gray-700 rounded-md transition">
                        <span class="mr-2">{{ Auth::user()->name }}</span>
                        <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" x-cloak @click.away="dropdownOpen = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-xl z-50">
                        <ul class="py-2">
                            <li>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white transition rounded-md">
                                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-red-500 hover:text-white transition rounded-md">
                                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
