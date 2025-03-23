<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS (for modal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Charset and Viewport -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Title -->
<title>Available Cars | DiamntinaCar - Best Rental Cars</title>

<!-- Meta Description -->
<meta name="description" content="Browse the best available rental cars at DiamntinaCar. Book your preferred car for an exceptional travel experience at competitive prices and top-notch service.">

<!-- Meta Keywords -->
<meta name="keywords" content="Car Rental, Rental Cars, Book Cars, DiamntinaCar, Available Cars, Luxury Car Rental">

<!-- Robots -->
<meta name="robots" content="index, follow">

<!-- Canonical URL -->
<link rel="canonical" href="https://diamantinacar.com/available-cars">

<!-- Open Graph / Facebook -->
<meta property="og:title" content="Available Cars | DiamntinaCar - Best Rental Cars">
<meta property="og:description" content="Browse the best available rental cars at DiamntinaCar. Book your preferred car for an exceptional travel experience at competitive prices and top-notch service.">
<meta property="og:image" content="https://diamantinacar.com/assets/hero-section.jpg">
<meta property="og:url" content="https://diamantinacar.com/available-cars">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Available Cars | DiamntinaCar - Best Rental Cars">
<meta name="twitter:description" content="Browse the best available rental cars at DiamntinaCar. Book your preferred car for an exceptional travel experience at competitive prices and top-notch service.">
<meta name="twitter:image" content="https://diamantinacar.com/assets/hero-section.jpg">

</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
    @include('partials.loader')

@include('partials.navbar')

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-96" style="background-image: url('/assets/hero-section.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto h-full flex flex-col justify-center items-center relative z-10">
        <h1 class="text-5xl font-bold text-white mb-4">Available Cars</h1>
        <p class="text-xl text-white mb-6">Find the best cars for your trip</p>
        <a href="#reservation" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
            Book Now
        </a>
    </div>
</section>

<!-- Car Listing Section -->
<section class="container mx-auto my-12 px-4">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
        <i class="fas fa-car mr-2 text-blue-500"></i>
        Available Cars
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($cars as $car)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
          @if ($car->image)
            <img src="{{ asset('storage/' . $car->image) }}"loading="lazy" class="w-full h-48 object-cover" alt="{{ $car->name }}">
          @else
            <img src="default-car.jpg" alt="Default Car" class="w-full h-48 object-cover">
          @endif
          <div class="p-6">
            <h5 class="text-xl font-bold text-gray-800 flex items-center mb-4">
              <i class="fas fa-car-side text-blue-500 mr-2"></i>
              {{ $car->name }}
            </h5>
            <!-- تفاصيل السيارة -->
            <div class="grid grid-cols-2 gap-4 text-gray-600 text-sm">
              <div class="flex items-center">
                <i class="fas fa-snowflake mr-1"></i>
                <span>AC: {{ $car->ac ? 'Yes' : 'No' }}</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-gas-pump mr-1"></i>
                <span>Fuel: {{ $car->fuel }}</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-users mr-1"></i>
                <span>Seats: {{ $car->seats }}</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-suitcase-rolling mr-1"></i>
                <span>Luggage: {{ $car->luggage }}</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-cogs mr-1"></i>
                <span>Transmission: {{ $car->transmission }}</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-map-marker-alt mr-1"></i>
                <span>Location: {{ $car->location }}</span>
              </div>
            </div>
            <!-- سعر الإيجار -->
            <div class="mt-4 bg-green-50 p-3 rounded-md text-center">
              <p class="text-lg font-bold text-green-600">
                <i class="fas fa-dollar-sign mr-1"></i>
                ${{ $car->price }} / day
              </p>
            </div>
            <!-- الأزرار -->
            <div class="mt-4 flex flex-wrap gap-4">
                <!-- Book Now Button -->
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 flex-1"
                        onclick="openModal({{ $car->id }}, this)" data-location="{{ $car->location }}">
                    Book Now
                </button>

                <!-- View Details Button -->
                <a href="{{ route('cars.show', $car->id) }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    View Details
                </a>
            </div>

          </div>
        </div>
        @endforeach
      </div>

</section>

<!-- Reservation Modal (Bootstrap Modal) -->
<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-600 text-white">
                <h5 class="modal-title" id="reservationModalLabel">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Reservation Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reservationForm" action="{{ route('reservations.confirm') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="car_id" id="car_id">
                    <!-- Pickup Location -->
                    <div>
                        <label for="modal_pickup_location" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Pickup Location
                        </label>
                        <select name="pickup_location" id="modal_pickup_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                            <option value="" disabled selected>Select Pickup Location</option>
                            <option value="Marrakech (Agence)">Marrakech (Agence)</option>
                            <option value="Marrakech medina">Marrakech medina</option>
                            <option value="Marrakech aéroport">Marrakech aéroport</option>
                            <option value="Essaouira">Essaouira</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Mohammedia">Mohammedia</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Ouarzazate">Ouarzazate</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Fès">Fès</option>
                        </select>
                    </div>
                    <!-- Drop-off Location -->
                    <div>
                        <label for="modal_dropoff_location" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Drop-off Location
                        </label>
                        <select name="dropoff_location" id="modal_dropoff_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                            <option value="" disabled selected>Select Drop-off Location</option>
                            <option value="Marrakech (Agence)">Marrakech (Agence)</option>
                            <option value="Marrakech medina">Marrakech medina</option>
                            <option value="Marrakech aéroport">Marrakech aéroport</option>
                            <option value="Essaouira">Essaouira</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Mohammedia">Mohammedia</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Ouarzazate">Ouarzazate</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Fès">Fès</option>
                        </select>
                    </div>
                    <!-- Pickup Date -->
                    <div>
                        <label for="modal_pickup_date" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Pickup Date
                        </label>
                        <input type="datetime-local" id="modal_pickup_date" name="pickup_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                    </div>
                    <!-- Return Date -->
                    <div>
                        <label for="modal_return_date" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Return Date
                        </label>
                        <input type="datetime-local" id="modal_return_date" name="return_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                        <i class="fas fa-check mr-2"></i>
                        Confirm Reservation
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
@include('partials.up')


<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Modal Open Function -->
<script>
    function formatDateTime(date) {
        const pad = (num) => num.toString().padStart(2, '0');
        return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
    }

    function openModal(carId, button) {
        // Set car_id value in the form
        document.getElementById('car_id').value = carId;

        // Read car location from the clicked button
        const carLocation = button.getAttribute('data-location');

        // Set default pickup_location value
        const pickupLocationSelect = document.getElementById('modal_pickup_location');
        pickupLocationSelect.value = carLocation;

        // Set default dates
        const now = new Date();
        const twoDaysLater = new Date();
        twoDaysLater.setDate(now.getDate() + 2);
        document.getElementById("modal_pickup_date").value = formatDateTime(now);
        document.getElementById("modal_return_date").value = formatDateTime(twoDaysLater);

        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('reservationModal'));
        modal.show();
    }
</script>
</body>
</html>
