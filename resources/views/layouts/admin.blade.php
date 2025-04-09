<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
            <div class="flex flex-col h-full">
                <div class="p-4 border-b">
                    <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
                </div>
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-home mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.reviews.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-star mr-3"></i>
                        Reviews
                    </a>
                    <a href="{{ route('admin.cars.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-car mr-3"></i>
                        Cars
                    </a>
                </nav>
                <div class="p-4 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 p-8">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h2>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="Profile" class="w-8 h-8 rounded-full">
                            <span>{{ Auth::user()->name }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Page Content -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Confirmation dialog
        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this item?')) {
                event.preventDefault();
            }
        }
    </script>
</body>
</html> 