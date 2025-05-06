<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservations Dashboard</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <x-app-layout>
        @include('partials.up')

  <div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h1 class="text-4xl font-bold text-gray-800">Reservations Dashboard</h1>
      <p class="text-gray-600 mt-2">Overview and management of reservations for the selected month.</p>
    </div>

    <!-- Dashboard Overview Cards & Month Filter Form (affecting summary stats only) -->
    <form method="GET" action="{{ route('reservations.index') }}">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 items-center">
        <!-- Total Reservations -->
        <div x-data="{ showReviews: false }" class="bg-white shadow rounded-lg p-6 cursor-pointer hover:scale-105 transition" @click="showReviews = true">
          <div class="flex items-center">
            <div class="bg-red-500 rounded-full p-3">
              <i class="fas fa-calendar-check text-white text-2xl"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-gray-700">Total Reservations</h3>
              <p class="text-2xl font-bold text-gray-800">{{ $totalReservations ?? 0 }}</p>
            </div>
          </div>

          <!-- Modal for Monthly Reservations -->
          <div x-show="showReviews" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" @click.self="showReviews = false" @keydown.escape.window="showReviews = false">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-2 p-6 relative" @click.stop>
              <button @click="showReviews = false" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl" title="Close">&times;</button>
              <h2 class="text-xl font-bold mb-4 text-red-600 flex items-center gap-2"><i class="fas fa-calendar-check"></i> Reservations This Month</h2>
              <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                  <thead class="bg-gray-100">
                    <tr>
                      <th class="py-2 px-2">ID</th>
                      <th class="py-2 px-2">Name</th>
                      <th class="py-2 px-2">Car</th>
                      <th class="py-2 px-2">Pickup</th>
                      <th class="py-2 px-2">Return</th>
                      <th class="py-2 px-2">Payment Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($monthlyReservations as $res)
                      <tr class="border-b">
                        <td class="py-1 px-2">{{ $res->id }}</td>
                        <td class="py-1 px-2">{{ $res->name }}</td>
                        <td class="py-1 px-2">{{ $res->car_name ?? ($res->car->name ?? '-') }}</td>
                        <td class="py-1 px-2">{{ $res->pickup_date }}</td>
                        <td class="py-1 px-2">{{ $res->return_date }}</td>
                        <td class="py-1 px-2">{{ $res->payment_status ?? '-' }}</td>
                      </tr>
                    @empty
                      <tr><td colspan="6" class="text-center text-gray-400 py-2">No reservations found.</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Total Income (paid only) -->
        <div class="bg-white shadow rounded-lg p-6">
          <div class="flex items-center">
            <div class="bg-green-500 rounded-full p-3">
              <i class="fas fa-dollar-sign text-white text-2xl"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-gray-700">Total Income</h3>
              <p class="text-2xl font-bold text-gray-800">${{ number_format($totalIncome ?? 0, 2) }}</p>
            </div>
          </div>
        </div>
        <!-- Unique Cars Rented -->
        <div x-data="{ showModal: false }" class="bg-white shadow rounded-lg p-6 cursor-pointer hover:scale-105 transition" @click="showModal = true">
          <div class="flex items-center">
            <div class="bg-yellow-500 rounded-full p-3">
              <i class="fas fa-car-side text-white text-2xl"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-gray-700">Unique Cars Rented</h3>
              <p class="text-2xl font-bold text-gray-800">{{ $uniqueCars ?? 0 }}</p>
            </div>
          </div>

          <!-- Modal -->
          <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" @click.self="showModal = false" @keydown.escape.window="showModal = false">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-2 p-6 relative" @click.stop>
              <button @click="showModal = false" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl" title="Close">&times;</button>
              <h2 class="text-xl font-bold mb-4 text-yellow-600 flex items-center gap-2"><i class="fas fa-car-side"></i> Unique Cars List</h2>
              <ul class="space-y-2 max-h-72 overflow-y-auto">
                @forelse($uniqueRentedCars as $car)
                  <li class="flex items-center gap-3 border-b pb-2">
                    @if($car->image)
                      <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->name }}" class="w-10 h-10 object-cover rounded shadow">
                    @else
                      <span class="w-10 h-10 bg-gray-200 flex items-center justify-center rounded text-gray-400"><i class="fas fa-car"></i></span>
                    @endif
                    <span class="font-semibold text-gray-700">{{ $car->name }}</span>
                  </li>
                @empty
                  <li class="text-gray-400">No cars found.</li>
                @endforelse
              </ul>
            </div>
          </div>
        </div>
        <!-- Month Filter Button (affects summary stats only) -->
        <div class="text-center">
          <label for="month" class="block text-gray-700 font-medium mb-2">Select Month</label>
          <input type="month" name="month" id="month" class="border rounded-lg px-3 py-2 w-full mb-2" value="{{ request('month', date('Y-m')) }}">
          <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-200">
            <i class="fas fa-search mr-2"></i>
            View Data
          </button>
        </div>
      </div>
    </form>

    <!-- Full Filter Form Section (affecting table data only) -->
    <div class="bg-white shadow rounded-lg p-2 mb-4 border border-gray-100 max-w-full">
      <form method="GET" action="{{ route('reservations.index') }}">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-1 items-end">
          <!-- Reservation ID Filter -->
          <div class="flex flex-col gap-0.5">
            <label for="id" class="text-xs text-gray-600 flex items-center gap-1"><i class="fas fa-hashtag text-gray-300"></i>ID</label>
            <input type="number" name="id" id="id" placeholder="#" class="border border-gray-200 focus:border-red-400 rounded px-1 py-0.5 text-xs bg-gray-50" value="{{ request('id') }}">
          </div>
          <!-- Reservation Date -->
          <div class="flex flex-col gap-0.5">
            <label for="reservation_date" class="text-xs text-gray-600 flex items-center gap-1"><i class="fas fa-calendar-day text-gray-300"></i>Date</label>
            <input type="date" name="reservation_date" id="reservation_date" class="border border-gray-200 focus:border-red-400 rounded px-1 py-0.5 text-xs bg-gray-50" value="{{ request('reservation_date') }}">
          </div>
          <!-- Name -->
          <div class="flex flex-col gap-0.5">
            <label for="name" class="text-xs text-gray-600 flex items-center gap-1"><i class="fas fa-user text-gray-300"></i>Name</label>
            <input type="text" name="name" id="name" placeholder="Name" class="border border-gray-200 focus:border-red-400 rounded px-1 py-0.5 text-xs bg-gray-50" value="{{ request('name') }}">
          </div>
          <!-- Date Range -->
          <div class="flex flex-col gap-0.5">
            <label class="text-xs text-gray-600 flex items-center gap-1"><i class="fas fa-calendar-alt text-gray-300"></i>Range</label>
            <div class="flex gap-1">
              <input type="date" name="start_date" id="start_date" class="border border-gray-200 focus:border-red-400 rounded px-1 py-0.5 text-xs bg-gray-50 w-full" value="{{ request('start_date') }}">
              <input type="date" name="end_date" id="end_date" class="border border-gray-200 focus:border-red-400 rounded px-1 py-0.5 text-xs bg-gray-50 w-full" value="{{ request('end_date') }}">
            </div>
          </div>
        </div>
        <div class="mt-2 flex flex-row justify-end gap-1">
          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-xs font-bold flex items-center justify-center">
            <i class="fas fa-filter mr-1"></i>
            Filter
          </button>
          <a href="{{ route('reservations.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1 rounded text-xs font-bold flex items-center justify-center">
            <i class="fas fa-undo mr-1"></i>
            Reset
          </a>
        </div>
      </form>
    </div>

    <!-- Reservations Table Section (all fields displayed) -->
    <div class="bg-white shadow rounded-lg overflow-x-auto">
      <table class="min-w-full">
        <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
          <tr>
            <th class="py-3 px-4 border-b">#</th>
            <th class="py-3 px-4 border-b">Car</th>
            <th class="py-3 px-4 border-b">Pickup Location</th>
            <th class="py-3 px-4 border-b">Dropoff Location</th>
            <th class="py-3 px-4 border-b">Pickup Date</th>
            <th class="py-3 px-4 border-b">Return Date</th>
            <th class="py-3 px-4 border-b">Name</th>
            <th class="py-3 px-4 border-b">Email</th>
            <th class="py-3 px-4 border-b">Phone</th>
            <th class="py-3 px-4 border-b">Payment Status</th>
            <th class="py-3 px-4 border-b">Payment Method</th>
            <th class="py-3 px-4 border-b">GPS</th>
            <th class="py-3 px-4 border-b">Maxicosi</th>
            <th class="py-3 px-4 border-b">Child Seat</th>
            <th class="py-3 px-4 border-b">Booster Seat</th>
            <th class="py-3 px-4 border-b">Franchise</th>
            <th class="py-3 px-4 border-b">Rachat</th>
            <th class="py-3 px-4 border-b">Payment Status</th>
            <th class="py-3 px-4 border-b">Total (€)</th>
            <th class="py-3 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
          @foreach ($reservations as $reservation)
            <tr class="hover:bg-gray-50 transition duration-150">
              <td class="py-2 px-4 border-b">{{ $reservation->id }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->car_name }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->pickup_location }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->dropoff_location }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->pickup_date }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->return_date }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->name }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->email }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->phone }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->payment_status }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->payment_method }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->gps ? 'Yes' : 'No' }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->maxicosi }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->siege_bebe }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->rehausseur }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->franchise ? 'Yes' : 'No' }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->rachat_franchise ? 'Yes' : 'No' }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->payment_status ?? '-' }}</td>
              <td class="py-2 px-4 border-b">{{ number_format($reservation->total_price / 11, 2) }} €</td>
              <td class="py-2 px-4 border-b text-center">
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline-block ml-2">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mt-4">
        {{ $reservations->links() }}
    </div>
    @if ($reservations->count() === 0)
      <div class="text-center mt-4">
        <p class="text-gray-500">No reservations found.</p>
      </div>
    @endif

  </div>


</x-app-layout>

</body>
</html>
