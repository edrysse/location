<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('messages.create_reservation_title') }}</title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // تمرير المتغيرات السعرية مع التأكد من أنها ليست null
        // يتم تمرير القيم من الـ controller عبر المتغير $data
        var pricePerDay = Number({{ $data['price_per_day'] }});
        var price2to5 = Number({{ $data['price_2_to_5'] }});
        var price6to20 = Number({{ $data['price_6_to_20'] }});
        var pricePlus20 = Number({{ $data['price_plus_20'] }});
        var franchisePrice = Number({{ $data['franchise_price'] }});

        function calculateTotal() {
            console.log("{{ __('messages.calculating_total') }}");

            const pickupDateInput = document.getElementById('pickup_date_input');
            const returnDateInput = document.getElementById('return_date_input');
            if (!pickupDateInput || !returnDateInput) return;

            const pickupDate = new Date(pickupDateInput.value);
            const returnDate = new Date(returnDateInput.value);
            const msPerDay = 1000 * 60 * 60 * 24;
            const diffDays = Math.ceil((returnDate - pickupDate) / msPerDay);
            const days = diffDays > 0 ? diffDays : 1;
            console.log("{{ __('messages.days_count') }}", days);

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
            const childSeat = (parseInt(document.getElementById('siege_bebe')?.value) || 0) * days;
            // إذا كنت تستخدم خيارات أخرى يمكن إضافتها هنا بنفس الطريقة
            const fullTank = document.querySelector('input[name="full_tank"]:checked')?.value === '1' ? 60 : 0;
            const franchise = document.querySelector('input[name="franchise"]:checked')?.value === '1' ? franchisePrice * days : 0;

            total += gps + maxicosi + childSeat + fullTank + franchise;

            // زيادة 3% في حالة اختيار Credit Card كطريقة للدفع
            var paymentMethod = document.getElementById('payment_method').value;
            if (paymentMethod === 'Credit Card (+3%)') {
                total *= 1.03;
            }

            console.log("{{ __('messages.total_cost') }}", total);
            document.getElementById('total').innerText = "{{ __('messages.total_label') }} " + total.toFixed(2);
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
<body class="bg-gradient-to-r from-red-50 to-red-100 min-h-screen flex flex-col">
  @include('partials.loader')
  @include('partials.navbar')
  @include('partials.up')

  <!-- Main Content Container -->
  <div class="container mx-auto flex-1 py-10 px-4 sm:px-6 lg:px-8">
    <!-- Page Title -->
    <h1 class="text-4xl font-extrabold text-center text-gray-800">
      <i class="fas fa-car-side mr-2 text-red-500"></i>
      {{ __('messages.create_reservation_header') }}
    </h1>
    <p class="text-center text-gray-500 mt-2">{{ __('messages.create_reservation_subheader') }}</p>

    <!-- Error Message -->
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-6 mb-4">
        <strong class="font-bold">{{ __('messages.whoops') }}</strong>
        <span class="block sm:inline">{{ $errors->first() }}</span>
      </div>
    @endif

    <!-- Two Columns Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

      <!-- Left Column: Reservation Information (Sticky) -->
      <div class="md:sticky md:top-10">
        <div class="bg-white shadow-lg rounded-lg p-4 border border-gray-200">
          <h2 class="text-xl font-bold mb-3 text-gray-700">
            <i class="fas fa-info-circle mr-2 text-red-400"></i>
            {{ __('messages.reservation_information') }}
          </h2>
          <div class="text-sm text-gray-600 space-y-1">
            <p><strong>{{ __('messages.car') }}</strong> {{ $data['car_name'] }}</p>
            <p><strong>{{ __('messages.pickup_location') }}</strong> {{ $data['pickup_location'] }}</p>
            <p><strong>{{ __('messages.dropoff_location') }}</strong> {{ $data['dropoff_location'] }}</p>
            <p><strong>{{ __('messages.pickup_date') }}</strong> {{ $data['pickup_date'] }}</p>
            <p><strong>{{ __('messages.return_date') }}</strong> {{ $data['return_date'] }}</p>
          </div>
          <p class="text-lg font-bold text-green-600 mt-4" id="total">{{ __('messages.total_label') }} 0.00</p>
        </div>
      </div>

      <!-- Right Column: Reservation Form -->
      <div>
        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
          <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- حقول مخفية لتواريخ وأماكن الحجز -->
            <input type="hidden" id="pickup_date_input" name="pickup_date" value="{{ $data['pickup_date'] }}">
            <input type="hidden" id="return_date_input" name="return_date" value="{{ $data['return_date'] }}">
            <input type="hidden" name="car_id" value="{{ $data['car_id'] }}">
            <input type="hidden" name="pickup_location" value="{{ $data['pickup_location'] }}">
            <input type="hidden" name="dropoff_location" value="{{ $data['dropoff_location'] }}">
            <!-- حالة الدفع المخفية (افتراضي: pending) -->
            <input type="hidden" name="payment_status" value="pending">

            <!-- حقل الاسم -->
            <div>
              <label for="name" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-user mr-2 text-red-400"></i>
                {{ __('messages.name') }}
              </label>
              <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="{{ __('messages.name_placeholder') }}">
            </div>

            <!-- حقل البريد الإلكتروني -->
            <div>
              <label for="email" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-envelope mr-2 text-red-400"></i>
                {{ __('messages.email') }}
              </label>
              <input type="email" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="{{ __('messages.email_placeholder') }}">
              <div class="text-sm text-gray-500 mt-1">
                {{ __('messages.email_note') }}
              </div>
            </div>

            <!-- حقل الهاتف -->
            <div>
              <label for="phone" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-phone mr-2 text-red-400"></i>
                {{ __('messages.phone') }}
              </label>
              <input type="text" name="phone" id="phone" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="{{ __('messages.phone_placeholder') }}">
            </div>

            <!-- حقول خيارات إضافية مخفية -->
            <input type="hidden" name="payment_method" id="payment_method" value="Cash">
            <div class="hidden">
              <label for="gps" class="block text-sm font-semibold text-gray-700">
                {{ __('messages.gps') }}
              </label>
              <input type="radio" name="gps" value="1"> نعم
              <input type="radio" name="gps" value="0" checked> لا
            </div>

            <div class="hidden">
              <label for="maxicosi" class="block text-sm font-semibold text-gray-700">
                {{ __('messages.maxicosi') }}
              </label>
              <input type="number" name="maxicosi" id="maxicosi" value="0" min="0" max="2">
            </div>

            <div class="hidden">
              <label for="siege_bebe" class="block text-sm font-semibold text-gray-700">
                {{ __('messages.siege_bebe') }}
              </label>
              <input type="number" name="siege_bebe" id="siege_bebe" value="0" min="0" max="2">
            </div>

            <div class="hidden">
              <label for="full_tank" class="block text-sm font-semibold text-gray-700">
                {{ __('messages.full_tank') }}
              </label>
              <input type="radio" name="full_tank" value="1"> نعم
              <input type="radio" name="full_tank" value="0" checked> لا
            </div>

            <div class="hidden">
              <label for="franchise" class="block text-sm font-semibold text-gray-700">
                {{ __('messages.franchise') }}
              </label>
              <input type="radio" name="franchise" value="1"> نعم
              <input type="radio" name="franchise" value="0" checked> لا
            </div>

            <!-- الموافقة على الشروط والأحكام -->
            <div class="pt-4">
              <label class="inline-flex items-center">
                <input type="checkbox" name="terms_agreement" required class="form-checkbox h-5 w-5 text-red-600">
                <span class="ml-2 text-gray-700">
                  {{ __('messages.terms_agreement') }}
                  <a href="{{ LaravelLocalization::localizeURL(route('nav.terms')) }}" class="text-red-600 hover:underline" target="_blank">
                    {{ __('messages.terms_link') }}
                  </a>
                </span>
              </label>
            </div>

            <!-- زر التأكيد -->
            <div class="pt-4">
              <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition-colors duration-300">
                <i class="fas fa-check mr-2"></i>{{ __('messages.create_reservation_button') }}
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
