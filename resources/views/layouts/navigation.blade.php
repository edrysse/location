<!-- Desktop Sidebar Navigation -->
<nav x-data="{ open: false, collapsed: false }" x-init="$watch('collapsed', value => { window.dispatchEvent(new CustomEvent('sidebar-collapsed', { detail: value })); $root.collapsed = value })" :class="collapsed ? 'lg:w-20' : 'lg:w-56'" class="hidden lg:fixed lg:top-0 lg:left-0 lg:h-full bg-gray-900 shadow-lg lg:flex flex-col z-40 transition-all duration-300">
    <div class="flex flex-col h-full">
        <!-- Collapse Button -->
        <div class="flex justify-end p-2">
            <button @click="collapsed = !collapsed" class="text-gray-400 hover:text-white focus:outline-none">
                <i :class="collapsed ? 'fas fa-chevron-right' : 'fas fa-chevron-left'"></i>
            </button>
        </div>
        <!-- Large Logo -->
        <div class="flex items-center justify-center h-24 border-b border-gray-800 transition-all duration-300" :class="collapsed ? 'h-16' : 'h-24'">
            <a href="{{ route('dashboard') }}">
                <x-application-logo :class="collapsed ? 'h-10' : 'h-16'" class="block w-auto fill-current text-white transition-all duration-300" />
            </a>
        </div>
        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto py-6 lg:block">
            <ul class="flex flex-col space-y-2 px-2">
                <li>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-tachometer-alt text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Dashboard</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-home text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Home</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('admin.cars.index')" :active="request()->routeIs('admin.cars.index')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-car text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Cars</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-calendar-alt text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Reservations</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-envelope text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Contacts</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.index')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-star text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Reviews</span>
                    </x-nav-link>
                </li>
                @can('viewAdminPages')
                <li>
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-user-shield text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Admin Dashboard</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="flex items-center px-2 py-3 rounded-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-users-cog text-lg mr-0 lg:mr-3"></i>
                        <span x-show="!collapsed" class="ml-3">Manage Users</span>
                    </x-nav-link>
                </li>
                @endcan
            </ul>
        </div>
        <div class="border-t border-gray-800 px-2 py-4 flex flex-col items-center">
            @auth
            <div class="flex flex-row items-center gap-2 w-full justify-center">
                <a href="/profile" class="flex flex-row items-center group">
                    <span class="text-gray-300"><i class="fas fa-user-circle text-2xl group-hover:text-blue-400 transition"></i></span>
                    <span x-show="!collapsed" class="text-gray-200 font-semibold text-sm ml-1">{{ Auth::user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex flex-row items-center text-gray-300 hover:text-red-500 transition ml-2">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                        <span x-show="!collapsed" class="text-sm font-semibold ml-1">Logout</span>
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</nav>

<!-- Mobile Top Navbar -->
<nav x-data="{ open: false }" class="lg:hidden fixed top-0 left-0 w-full bg-gray-900 shadow-lg flex items-center justify-between h-14 z-50">
    <!-- Logo (left) -->
    <div class="flex items-center px-2">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-8 w-auto fill-current text-white transition-all duration-300" />
        </a>
    </div>
    <!-- Burger (right) -->
    <div class="flex items-center px-2">
        <button @click="open = !open" class="text-gray-300 focus:outline-none">
            <i :class="open ? 'fas fa-times' : 'fas fa-bars'" class="text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Drawer Navigation -->
    <div x-show="open" @click.away="open = false" class="fixed top-14 left-0 w-full bg-gray-900 shadow-lg z-50 transition-all duration-300">
        <ul class="flex flex-col space-y-2 px-4 py-4">
            <li>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-tachometer-alt text-lg mr-3"></i>
                    <span>Dashboard</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-home text-lg mr-3"></i>
                    <span>Home</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('admin.cars.index')" :active="request()->routeIs('admin.cars.index')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-car text-lg mr-3"></i>
                    <span>Cars</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-calendar-alt text-lg mr-3"></i>
                    <span>Reservations</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-envelope text-lg mr-3"></i>
                    <span>Contacts</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.index')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-star text-lg mr-3"></i>
                    <span>Reviews</span>
                </x-nav-link>
            </li>
            @can('viewAdminPages')
            <li>
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-user-shield text-lg mr-3"></i>
                    <span>Admin Dashboard</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="flex items-center px-4 py-4 rounded-lg text-lg text-gray-200 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-users-cog text-lg mr-3"></i>
                    <span>Manage Users</span>
                </x-nav-link>
            </li>
            @endcan
        </ul>
        <!-- Profile/User Section -->
        <div class="border-t border-gray-800 px-4 py-4">
            @auth
            <div class="flex items-center space-x-2">
                <span class="text-gray-300"><i class="fas fa-user-circle text-xl"></i></span>
                <span class="text-gray-200 font-semibold">
                    <a href="/profile" class="hover:underline">{{ Auth::user()->name }}</a>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-600 transition ml-4"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
            @else
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="text-gray-200 hover:text-white">Login</a>
                <a href="{{ route('register') }}" class="text-gray-200 hover:text-white">Register</a>
            </div>
            @endauth
        </div>
    </div>
</nav>
