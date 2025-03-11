<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Diamantina car</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap CSS (للمودال) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@8.4.5/swiper-bundle.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- Slick Carousel CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

<!-- Slick Carousel JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
    @include('partials.loader') 
  @include('partials.navbar')

  <!-- Hero Section -->
  <section class="relative bg-cover bg-center h-96" style="background-image: url('/assets/hero-section.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto h-full flex flex-col justify-center items-center relative z-10">
      <h1 class="text-5xl font-bold text-white mb-4">Welcome to Diamantina Car</h1>
      <p class="text-xl text-white mb-6">Best deals, best service, ride with confidence</p>
      <a href="#reservation" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
        Book Now
      </a>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800">Why Choose Us</h2>
      <p class="text-gray-600 mt-2">We provide the best car rental services with unbeatable offers</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- تعديل البطاقة الأولى لتصبح "توصيل مجاني بمدينة مراكش" -->
      <div class="bg-white p-6 rounded-lg shadow-lg text-center"> <i class="fas fa-truck-moving text-blue-600 text-4xl mb-4"></i> <h3 class="text-xl font-semibold mb-2">Free Delivery in Marrakech</h3> <p class="text-gray-600">Enjoy free delivery service when receiving your car in Marrakech.</p> </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-dollar-sign text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">Affordable Prices</h3>
        <p class="text-gray-600">Enjoy competitive pricing with no hidden fees.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-headset text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">24/7 Support</h3>
        <p class="text-gray-600">Our team is available around the clock for any assistance.</p>
      </div>
    </div>
  </section>

  <!-- Reservation Form Section -->
  <section id="reservation" class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <h2 class="text-3xl font-bold text-center mb-6">
        <i class="fas fa-calendar-check mr-2 text-blue-500"></i>
        Make a Reservation
      </h2>
      <form action="{{ route('cars') }}" method="GET">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Pickup Location -->
          <div>
            <label for="pickup_location" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-map-marker-alt mr-1"></i>
              Pickup Location
            </label>
            <select name="pickup_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
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
            <label for="dropoff_location" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-map-marker-alt mr-1"></i>
              Drop-off Location
            </label>
            <select name="dropoff_location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
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
            <label for="pickup_date" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-calendar-alt mr-1"></i>
              Pickup Date
            </label>
            <input type="datetime-local" id="pickup_date" name="pickup_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
          </div>
          <!-- Return Date -->
          <div>
            <label for="return_date" class="block text-gray-700 font-medium mb-2">
              <i class="fas fa-calendar-alt mr-1"></i>
              Return Date
            </label>
            <input type="datetime-local" id="return_date" name="return_date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500" required>
          </div>
        </div>
        <div class="text-center mt-6">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
            <i class="fas fa-search mr-2"></i>
            Find Cars
          </button>
        </div>
      </form>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      function formatDateTime(date) {
        const pad = (num) => num.toString().padStart(2, '0');
        return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
      }
      const now = new Date();
      const twoDaysLater = new Date();
      twoDaysLater.setDate(now.getDate() + 2);
      document.getElementById("pickup_date").value = formatDateTime(now);
      document.getElementById("return_date").value = formatDateTime(twoDaysLater);
    });
  </script>

  <!-- Car Listing Section (عرض 3 سيارات فقط) -->
  <section class="container mx-auto my-12 px-4">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
      <i class="fas fa-car mr-2 text-blue-500"></i>
      Our Cars
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($cars->take(3) as $car)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
          @if ($car->image)
            <img src="{{ asset('storage/' . $car->image) }}" class="w-full h-48 object-cover" alt="{{ $car->name }}">
          @else
            <img src="default-car.jpg" alt="Default Car" class="w-full h-48 object-cover">
          @endif
          <div class="p-6">
            <h5 class="text-xl font-bold text-gray-800 flex items-center mb-4">
              <i class="fas fa-car-side text-blue-500 mr-2"></i>
              {{ $car->name }}
            </h5>
            <!-- Car Details -->
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
            <!-- Price Per Day with a professional look -->
            <div class="mt-4 bg-green-50 p-3 rounded-md text-center">
              <p class="text-lg font-bold text-green-600">
                <i class="fas fa-dollar-sign mr-1"></i>
                ${{ $car->price }} / day
              </p>
            </div>
            <!-- Button to Open the Modal -->
            <div class="mt-4">
              <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 w-full"
                onclick="openModal({{ $car->id }}, this)"
                data-location="{{ $car->location }}">
                <i class="fas fa-bookmark mr-2"></i>
                Book Now
              </button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      
      
    <!-- زر الانتقال إلى صفحة جميع السيارات -->
    <div class="text-center mt-8">
      <a href="/available-cars" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full transition duration-200">
        View All Cars
      </a>
    </div>
  </section>

 <!-- Testimonials Section -->
<section class="container mx-auto my-12 px-4">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Testimonials</h2>
        <p class="text-gray-600 mt-2">Hear from our happy customers</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($reviews as $review)
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-gray-600 italic mb-4">"{{ $review->comment }}"</p>
                <div class="flex items-center space-x-4">
                    @if($review->avatar)
                        <img src="{{ asset('storage/' . $review->avatar) }}" class="w-16 h-16 rounded-full object-cover" alt="Customer">
                    @else
                        <img src="https://via.placeholder.com/50" class="w-16 h-16 rounded-full object-cover" alt="Customer">
                    @endif
                    <div>
                        <p class="font-bold text-gray-800">{{ $review->name }}</p>
                        <p class="text-gray-600 text-sm">{{ $review->position }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

  <script>
  function editReview(id) {
      document.getElementById('edit-form-' + id).classList.toggle('hidden');
  }
  </script>

      </div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Contact Us</h2>
        <p class="text-gray-600 mt-2">Have any questions? We'd love to hear from you.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-phone mr-2 text-blue-600"></i>
            Phone
          </h3>
          <p class="text-gray-600">+1 234 567 890</p>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-envelope mr-2 text-blue-600"></i>
            Email
          </h3>
          <p class="text-gray-600">info@carrental.com</p>
        </div>
        <div class="md:col-span-2">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
            Address
          </h3>
          <p class="text-gray-600">123 Main Street, City, Country</p>
        </div>
      </div>
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

  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper@8.4.5/swiper-bundle.min.js"></script>
  <!-- Modal Open Function -->
  <script>
    function formatDateTime(date) {
      const pad = (num) => num.toString().padStart(2, '0');
      return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T10:00`;
    }

    function openModal(carId, button) {
      // تعيين قيمة car_id في النموذج
      document.getElementById('car_id').value = carId;

      // قراءة موقع السيارة من الزر الذي تم النقر عليه
      const carLocation = button.getAttribute('data-location');

      // تعيين القيمة الافتراضية لـ pickup_location
      const pickupLocationSelect = document.getElementById('modal_pickup_location');
      pickupLocationSelect.value = carLocation;

      // تعيين التواريخ الافتراضية
      const now = new Date();
      const twoDaysLater = new Date();
      twoDaysLater.setDate(now.getDate() + 2);
      document.getElementById("modal_pickup_date").value = formatDateTime(now);
      document.getElementById("modal_return_date").value = formatDateTime(twoDaysLater);

      // عرض المودال
      var modal = new bootstrap.Modal(document.getElementById('reservationModal'));
      modal.show();
    }
  </script>
</body>
</html>
