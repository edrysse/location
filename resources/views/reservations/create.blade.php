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
        // تعريف المتغيرات العامة للأسعار
        @if(isset($data['season_price']))
            const pricePerDay = {{ $data['season_price']->price_per_day }};
            const price2Days = {{ $data['season_price']->price_2_days }};
            const price3to7Days = {{ $data['season_price']->price_3_7_days }};
            const price7PlusDays = {{ $data['season_price']->price_7_plus_days }};
        @else
            const pricePerDay = {{ $data['price_per_day'] }};
            const price2Days = {{ $data['price_2_days'] ?? $data['price_per_day'] }};
            const price3to7Days = {{ $data['price_3_7_days'] ?? $data['price_per_day'] }};
            const price7PlusDays = {{ $data['price_7_plus_days'] ?? $data['price_per_day'] }};
        @endif

        const franchisePrice = {{ $data['franchise_price'] ?? 0 }};
        const rachatFranchisePrice = {{ $data['rachat_franchise_price'] ?? 0 }};

        function calculateTotal() {
            const pickupDateInput = document.getElementById('pickup_date_input');
            const returnDateInput = document.getElementById('return_date_input');
            if (!pickupDateInput || !returnDateInput) return;

            const pickupDate = new Date(pickupDateInput.value);
            const returnDate = new Date(returnDateInput.value);
            const msPerDay = 1000 * 60 * 60 * 24;
            const diffDays = Math.round((returnDate - pickupDate) / msPerDay);
            const days = diffDays > 0 ? diffDays : 1;

            console.log('Days:', days);

            // تحديد السعر الإجمالي حسب عدد الأيام
            let total;
            if (days === 1) {
                total = pricePerDay;
            } else if (days === 2) {
                total = price2Days * 2;  // ضرب سعر اليومين في 2
            } else if (days >= 3 && days <= 7) {
                total = price3to7Days * days;
            } else {
                total = price7PlusDays * days;
            }

            console.log('Base total:', total);

            // إضافة الخيارات الإضافية
            const gps = document.querySelector('input[name="gps"]:checked')?.value === '1' ? 5 : 0;
            const maxicosi = parseInt(document.getElementById('maxicosi')?.value) || 0;
            const childSeat = parseInt(document.getElementById('siege_bebe')?.value) || 0;
            const fullTank = document.querySelector('input[name="full_tank"]:checked')?.value === '1' ? 60 : 0;
            const franchise = document.querySelector('input[name="franchise"]:checked')?.value === '1' ? franchisePrice : 0;
            const rachatFranchise = document.querySelector('input[name="rachat_franchise"]:checked')?.value === '1' ? rachatFranchisePrice : 0;

            // إضافة التكاليف اليومية
            total += (gps * days);
            total += (maxicosi * 3 * days);
            total += (childSeat * 3 * days);
            total += fullTank;
            total += franchise; // Franchise is charged only once
            total += (rachatFranchise * days);

            // إضافة الضريبة إذا تم اختيارها
            if (document.querySelector('input[name="vat"]:checked')?.value === '1') {
                total *= 1.03;
            }

            // عرض المجموع
            document.getElementById('total').innerText = "{{ __('messages.total_label') }} " + total.toFixed(2);
        }

        // حساب المجموع الأولي عند تحميل الصفحة
        calculateTotal();

        // إضافة مستمعي الأحداث
        document.querySelectorAll('input[type="radio"], input[type="number"], select').forEach(function(element) {
            element.addEventListener('change', calculateTotal);
        });
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
            <p><strong>{{ __('messages.car') }}</strong> {{ $data['car']->name }}</p>
            <p><strong>{{ __('messages.pickup_location') }}</strong> {{ $data['pickup_location'] }}</p>
            <p><strong>{{ __('messages.return_location') }}</strong> {{ $data['return_location'] }}</p>
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
            <input type="hidden" name="dropoff_location" value="{{ $data['return_location'] }}">
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
              <p class="text-sm text-gray-500 mt-1">{{ __('messages.email_note') }}</p>
            </div>

            <!-- حقل الهاتف -->
            <div>
              <label for="phone" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-phone mr-2 text-red-400"></i>
                {{ __('messages.phone') }}
              </label>
              <input type="text" name="phone" id="phone" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="{{ __('messages.phone_placeholder') }}">
            </div>

            <!-- Franchise Options -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-shield-alt text-red-500 mr-2"></i>
                    {{ __('messages.franchise_options') }}
                </label>
                <div class="mt-2 space-y-2">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input type="radio" name="franchise" id="franchise_yes" value="1" class="h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="franchise_yes" class="ml-2 text-sm text-gray-600">
                                <i class="fas fa-shield-halved text-blue-500 mr-1"></i>
                                {{ __('messages.franchise') }} 
                                @if(isset($car))
                                    ({{ $car->franchise_price }} DH)
                                @endif
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="franchise" id="franchise_no" value="0" class="h-4 w-4 text-indigo-600 border-gray-300" checked>
                            <label for="franchise_no" class="ml-2 text-sm text-gray-600">{{ __('messages.no') }}</label>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input type="radio" name="rachat_franchise" id="rachat_franchise_yes" value="1" class="h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="rachat_franchise_yes" class="ml-2 text-sm text-gray-600">
                                <i class="fas fa-shield-heart text-green-500 mr-1"></i>
                                {{ __('messages.rachat_franchise') }}
                                @if(isset($car))
                                    ({{ $car->rachat_franchise_price }} DH)
                                @endif
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="rachat_franchise" id="rachat_franchise_no" value="0" class="h-4 w-4 text-indigo-600 border-gray-300" checked>
                            <label for="rachat_franchise_no" class="ml-2 text-sm text-gray-600">{{ __('messages.no') }}</label>
                        </div>
                    </div>
                </div>
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
