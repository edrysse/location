<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New Reservation</title>
  <link rel="shortcut icon" href="favicon.ico" type="/assets/diam-logo.png">
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // تمرير المتغيرات السعرية مع التأكد من أنها ليست null
        var pricePerDay = {{ $data['price_per_day'] }};
        var price2to5 = {{ $data['price_2_to_5'] }};
        var price6to20 = {{ $data['price_6_to_20'] }};
        var pricePlus20 = {{ $data['price_plus_20'] ?? $data['price_per_day'] }};
        var franchisePrice = {{ $data['franchise_price'] }};

        function calculateTotal() {
            console.log("حساب التكلفة الإجمالية...");

            const pickupDateInput = document.getElementById('pickup_date_input');
            const returnDateInput = document.getElementById('return_date_input');
            if (!pickupDateInput || !returnDateInput) return;

            const pickupDate = new Date(pickupDateInput.value);
            const returnDate = new Date(returnDateInput.value);
            const msPerDay = 1000 * 60 * 60 * 24;
            const diffDays = Math.ceil((returnDate - pickupDate) / msPerDay);
            const days = diffDays > 0 ? diffDays : 1;
            console.log("عدد الأيام:", days);

            let dailyPrice;
            if (days === 1) {
                dailyPrice = pricePerDay;
            } else if (days >= 2 && days <= 5) {
                dailyPrice = price2to5;
            } else if (days >= 6 && days <= 20) {
                dailyPrice = price6to20;
            } else if (days > 20) {
                dailyPrice = pricePlus20;
            } else {
                dailyPrice = pricePerDay;
            }

            let total = dailyPrice * days;

            // إضافة التكاليف الخاصة بالخيارات الإضافية
            const gps = document.querySelector('input[name="gps"]:checked')?.value === '1' ? 1 * days : 0;
            const maxicosi = (parseInt(document.getElementById('maxicosi')?.value) || 0) * days;
            const childSeat = (parseInt(document.getElementById('child_seat')?.value) || 0) * days;
            const boosterSeat = (parseInt(document.getElementById('booster_seat')?.value) || 0) * days;
            const fullTank = document.querySelector('input[name="full_tank"]:checked')?.value === '1' ? 60 : 0;
            const franchise = document.querySelector('input[name="franchise"]:checked')?.value === '1' ? franchisePrice * days : 0;

            total += gps + maxicosi + childSeat + boosterSeat + fullTank + franchise;

            // زيادة 3% في حالة اختيار Credit Card كطريقة للدفع
            var paymentMethod = document.getElementById('payment_method').value;
            if (paymentMethod === 'Credit Card') {
                total *= 1.03;
            }

            console.log("التكلفة الإجمالية:", total);
            document.getElementById('total').innerText = "Total: $" + total.toFixed(2);
        }

        // إضافة event listener لجميع عناصر الإدخال والاختيار لحساب التكلفة عند تغييرها
        document.querySelectorAll('input, select').forEach(element => {
            element.addEventListener('change', calculateTotal);
        });

        // حساب التكلفة عند تحميل الصفحة
        calculateTotal();
    });
  </script>

</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen flex flex-col">
    @include('partials.loader')

  @include('partials.navbar')
  @include('partials.up')

  <!-- Main Content Container -->
  <div class="container mx-auto flex-1 py-10 px-4 sm:px-6 lg:px-8">
    <!-- Page Title -->
    <h1 class="text-4xl font-extrabold text-center text-gray-800">
      <i class="fas fa-car-side mr-2 text-blue-500"></i>
      Create New Reservation
    </h1>
    <p class="text-center text-gray-500 mt-2">Book your car quickly and easily</p>

    <!-- Error Message -->
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-6 mb-4">
        <strong class="font-bold">Whoops!</strong>
        <span class="block sm:inline">{{ $errors->first() }}</span>
      </div>
    @endif

    <!-- Two Columns Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

      <!-- Left Column: Reservation Information (Sticky) -->
      <div class="md:sticky md:top-10">
        <div class="bg-white shadow-lg rounded-lg p-4 border border-gray-200">
          <h2 class="text-xl font-bold mb-3 text-gray-700">
            <i class="fas fa-info-circle mr-2 text-blue-400"></i>
            Reservation Information
          </h2>
          <div class="text-sm text-gray-600 space-y-1">
            <p><strong>Car:</strong> {{ $data['car_name'] }}</p>
            <p><strong>Pickup Location:</strong> {{ $data['pickup_location'] }}</p>
            <p><strong>Dropoff Location:</strong> {{ $data['dropoff_location'] }}</p>
            <p><strong>Pickup Date:</strong> {{ $data['pickup_date'] }}</p>
            <p><strong>Return Date:</strong> {{ $data['return_date'] }}</p>
          </div>
          <p class="text-lg font-bold text-green-600 mt-4" id="total">Total: $0.00</p>
        </div>
      </div>

      <!-- Right Column: Reservation Form -->
      <div>
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
          <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Hidden Fields for Dates & Locations -->
            <input type="hidden" id="pickup_date_input" name="pickup_date" value="{{ $data['pickup_date'] }}">
            <input type="hidden" id="return_date_input" name="return_date" value="{{ $data['return_date'] }}">
            <input type="hidden" name="car_id" value="{{ $data['car_id'] }}">
            <input type="hidden" name="pickup_location" value="{{ $data['pickup_location'] }}">
            <input type="hidden" name="dropoff_location" value="{{ $data['dropoff_location'] }}">
            <!-- Hidden Payment Status (default pending) -->
            <input type="hidden" name="payment_status" value="pending">

            <!-- Name Field -->
            <div>
              <label for="name" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-user mr-2 text-blue-400"></i>
                Name
              </label>
              <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Your full name">
            </div>

            <!-- Email Field -->
            <div>
              <label for="email" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-envelope mr-2 text-blue-400"></i>
                Email
              </label>
              <input type="email" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="you@example.com">
            </div>

            <!-- Phone Field -->
            <div>
              <label for="phone" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-phone mr-2 text-blue-400"></i>
                Phone
              </label>
              <input type="text" name="phone" id="phone" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="+1 234 567 890">
            </div>

            <!-- Payment Method (Select) Field -->
            <div>
              <label for="payment_method" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-credit-card mr-2 text-blue-400"></i>
                Payment Method
              </label>
              <select name="payment_method" id="payment_method" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                <option value="" disabled selected>Select Payment Method</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Cash">Cash</option>
                <option value="Bank Transfer">Bank Transfer</option>
              </select>
            </div>

            <!-- Options Section: GPS, Maxicosi, Child Seat, Booster Seat, Full Tank, Franchise -->
            <div class="space-y-4">
              <!-- GPS ($1/day) Option -->
              <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-gray-700">GPS ($1/day)</label>
                <div class="flex items-center space-x-4">
                  <label class="inline-flex items-center">
                    <input type="radio" name="gps" value="1" onclick="calculateTotal()" class="text-blue-500">
                    <span class="ml-2">Yes</span>
                  </label>
                  <label class="inline-flex items-center">
                    <input type="radio" name="gps" value="0" checked onclick="calculateTotal()" class="text-blue-500">
                    <span class="ml-2">No</span>
                  </label>
                </div>
              </div>

              <!-- Maxicosi Option -->
              <div>
                <label for="maxicosi" class="block text-sm font-semibold text-gray-700">
                  <i class="fas fa-baby-carriage mr-2 text-blue-400"></i>Maxicosi ($1/day)
                </label>
                <select id="maxicosi" name="maxicosi" class="border rounded-md p-2" onchange="calculateTotal()">
                  <option value="0" selected>0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>

              <!-- Child Seat (Siege Bebe) Option -->
              <div>
                <label for="child_seat" class="block text-sm font-semibold text-gray-700">
                  <i class="fas fa-baby mr-2 text-blue-400"></i>Child Seat ($1/day)
                </label>
                <select id="child_seat" name="siege_bebe" class="border rounded-md p-2" onchange="calculateTotal()">
                  <option value="0" selected>0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>

              <!-- Booster Seat (Rehausseur) Option -->
              <div>
                <label for="booster_seat" class="block text-sm font-semibold text-gray-700">
                  <i class="fas fa-chair mr-2 text-blue-400"></i>Booster Seat (Rehausseur)
                </label>
                <select id="booster_seat" name="rehausseur" class="border rounded-md p-2" onchange="calculateTotal()">
                  <option value="0" selected>0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>

              <!-- Full Tank ($60) Option -->
              <div class="flex flex-col gap-2">
                <label class="block text-sm font-semibold text-gray-700">Full Tank ($60)</label>
                <div class="flex items-center space-x-4">
                  <label class="inline-flex items-center">
                    <input type="radio" name="full_tank" value="1" onclick="calculateTotal()" class="text-blue-500">
                    <span class="ml-2">Yes</span>
                  </label>
                  <label class="inline-flex items-center">
                    <input type="radio" name="full_tank" value="0" checked onclick="calculateTotal()" class="text-blue-500">
                    <span class="ml-2">No</span>
                  </label>
                </div>
              </div>

              <!-- Franchise Option -->
              <div class="flex flex-col gap-2">
                <p><strong>Franchise Price:</strong> ${{ isset($data['franchise_price']) ? number_format($data['franchise_price'], 2) : 'N/A' }}</p>
                <div class="flex items-center space-x-4">
                  <label class="inline-flex items-center">
                    <input type="radio" name="franchise" value="1" onclick="calculateTotal()" class="text-blue-500">
                    <span class="ml-2">Yes</span>
                  </label>
                  <label class="inline-flex items-center">
                    <input type="radio" name="franchise" value="0" checked onclick="calculateTotal()" class="text-blue-500">
                    <span class="ml-2">No</span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition-colors duration-300">
                <i class="fas fa-check mr-2"></i>Create Reservation
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @include('partials.footer')
</body>
</html>
