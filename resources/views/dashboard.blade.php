<x-app-layout>
    @include('partials.up')


    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- بطاقات الإحصائيات -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- بطاقة إجمالي السيارات -->
          <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
              <div class="p-3 bg-blue-500 rounded-full">
                <i class="fas fa-car text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500">Total Cars</p>
                <p class="text-2xl font-bold text-gray-800">{{ $carsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
          <!-- بطاقة الحجوزات -->
          <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
              <div class="p-3 bg-green-500 rounded-full">
                <i class="fas fa-calendar-check text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500">Reservations</p>
                <p class="text-2xl font-bold text-gray-800">{{ $reservationsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
          <!-- بطاقة التقييمات -->
          <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
              <div class="p-3 bg-yellow-500 rounded-full">
                <i class="fas fa-comments text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500">Reviews</p>
                <p class="text-2xl font-bold text-gray-800">{{ $reviewsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
          <!-- بطاقة رسائل الاتصال -->
          <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
              <div class="p-3 bg-red-500 rounded-full">
                <i class="fas fa-envelope text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500">Contact Messages</p>
                <p class="text-2xl font-bold text-gray-800">{{ $contactsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- قسم أحدث الحجوزات -->
        <div class="mt-10">
          <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Latest Reservations
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Recent reservations made by users.
              </p>
            </div>
            <div>
              @if(isset($latestReservations) && $latestReservations->count() > 0)
                @foreach($latestReservations as $reservation)
                  <div class="px-6 py-4 border-b border-gray-200 last:border-0">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                      <dt class="text-sm font-medium text-gray-500">
                        Reservation #{{ $reservation->id }}
                      </dt>
                      <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $reservation->car_name }} - Total: €{{ number_format($reservation->total_price, 2) }}
                      </dd>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="px-6 py-4">
                  <p class="text-sm text-gray-500">No recent reservations.</p>
                </div>
              @endif
            </div>
          </div>
        </div>

      </div>
    </div>
  </x-app-layout>
