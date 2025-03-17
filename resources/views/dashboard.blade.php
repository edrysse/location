<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
      </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Total Cars Card -->
          <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
            <div class="flex items-center">
              <div class="p-3 bg-blue-500 rounded-full">
                <i class="fas fa-car text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500 dark:text-gray-400">Total Cars</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $carsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
          <!-- Reservations Card -->
          <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
            <div class="flex items-center">
              <div class="p-3 bg-green-500 rounded-full">
                <i class="fas fa-calendar-check text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500 dark:text-gray-400">Reservations</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $reservationsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
          <!-- Reviews Card -->
          <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
            <div class="flex items-center">
              <div class="p-3 bg-yellow-500 rounded-full">
                <i class="fas fa-comments text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500 dark:text-gray-400">Reviews</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $reviewsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
          <!-- Contact Messages Card -->
          <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
            <div class="flex items-center">
              <div class="p-3 bg-red-500 rounded-full">
                <i class="fas fa-envelope text-white text-xl"></i>
              </div>
              <div class="ml-4">
                <p class="text-gray-500 dark:text-gray-400">Contact Messages</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $contactsCount ?? 0 }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Latest Reservations Section -->
        <div class="mt-10">
          <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                Latest Reservations
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                Recent reservations made by users.
              </p>
            </div>
            <div class="border-t border-gray-200">
              <dl>
                @if(isset($latestReservations) && $latestReservations->count() > 0)
                  @foreach($latestReservations as $reservation)
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                      <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Reservation #{{ $reservation->id }}
                      </dt>
                      <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">
                        {{ $reservation->car_name }} - Total: ${{ number_format($reservation->total_price, 2) }}
                      </dd>
                    </div>
                  @endforeach
                @else
                  <div class="px-4 py-5 sm:px-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">No recent reservations.</p>
                  </div>
                @endif
              </dl>
            </div>
          </div>
        </div>

      </div>
    </div>
  </x-app-layout>
