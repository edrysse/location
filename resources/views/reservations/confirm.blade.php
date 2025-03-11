<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed">

    @include('partials.navbar')

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-md">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Success/Error Alerts -->
    @if(session('success'))
    <div class="fixed top-10 right-10 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="fixed top-10 right-10 bg-red-500 text-white px-4 py-2 rounded-lg shadow-md">
        {{ session('error') }}
    </div>
    @endif

    <!-- Reservation Form -->
    <div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-lg max-w-4xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Create Reservation</h2>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="car_id" value="{{ $data['car_id'] }}">
            <input type="hidden" name="pickup_location" value="{{ $data['pickup_location'] }}">
            <input type="hidden" name="dropoff_location" value="{{ $data['dropoff_location'] }}">
            <input type="hidden" name="pickup_date" value="{{ $data['pickup_date'] }}">
            <input type="hidden" name="return_date" value="{{ $data['return_date'] }}">

            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700">Reservation Information</h3>
                <p class="text-lg">{{ $data['car_name'] }}</p>

                <div class="mt-4">
                    <p><strong>Pickup:</strong> {{ $data['pickup_location'] }}</p>
                    <p><strong>Date:</strong> {{ $data['pickup_date'] }}</p>
                    <p><strong>Drop-off:</strong> {{ $data['dropoff_location'] }}</p>
                    <p><strong>Date:</strong> {{ $data['return_date'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Options here... -->
                <!-- Include options for GPS, Maxi-cosi, etc. -->
            </div>

            <div class="mt-6">
                <!-- Name -->
                <div class="form-group mb-4">
                    <label for="name" class="text-lg font-medium text-gray-700">Your Name *</label>
                    <input type="text" name="name" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Email -->
                <div class="form-group mb-4">
                    <label for="email" class="text-lg font-medium text-gray-700">Your Email *</label>
                    <input type="email" name="email" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Phone -->
                <div class="form-group mb-4">
                    <label for="phone" class="text-lg font-medium text-gray-700">Your Phone *</label>
                    <input type="text" name="phone" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Flight Number -->
                <div class="form-group mb-4">
                    <label for="flight_number" class="text-lg font-medium text-gray-700">Flight Number</label>
                    <input type="text" name="flight_number" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Age Confirmation -->
                <div class="form-group mb-4">
                    <label for="age_confirmation" class="text-lg font-medium text-gray-700">I am over 23 years old</label>
                    <input type="checkbox" name="age_confirmation" class="mr-2" required>
                </div>

                <!-- Payment Method -->
                <div class="form-group mb-6">
                    <label for="payment_method" class="text-lg font-medium text-gray-700">Choose Payment Method</label>
                    <select name="payment_method" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                        <option value="cash_on_delivery">Cash</option>
                        <option value="online">Credit Card (+3%)</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-blue-600 text-white text-lg font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Reserve
                </button>
            </div>
        </form>
    </div>

    @include('partials.footer')
</body>
</html>