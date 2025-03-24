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
        <div class="bg-white shadow rounded-lg p-6">
          <div class="flex items-center">
            <div class="bg-blue-500 rounded-full p-3">
              <i class="fas fa-calendar-check text-white text-2xl"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-gray-700">Total Reservations</h3>
              <p class="text-2xl font-bold text-gray-800">{{ $totalReservations ?? 0 }}</p>
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
        <div class="bg-white shadow rounded-lg p-6">
          <div class="flex items-center">
            <div class="bg-yellow-500 rounded-full p-3">
              <i class="fas fa-car-side text-white text-2xl"></i>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-gray-700">Unique Cars Rented</h3>
              <p class="text-2xl font-bold text-gray-800">{{ $uniqueCars ?? 0 }}</p>
            </div>
          </div>
        </div>
        <!-- Month Filter Button (affects summary stats only) -->
        <div class="text-center">
          <label for="month" class="block text-gray-700 font-medium mb-2">Select Month</label>
          <input type="month" name="month" id="month" class="border rounded-lg px-3 py-2 w-full mb-2" value="{{ request('month', date('Y-m')) }}">
          <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
            <i class="fas fa-search mr-2"></i>
            View Data
          </button>
        </div>
      </div>
    </form>

    <!-- Full Filter Form Section (affecting table data only) -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
      <form method="GET" action="{{ route('reservations.index') }}">
        <!-- هنا لا يتم إرسال قيمة month حتى لا تؤثر على بيانات الجدول -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <!-- Reservation Date -->
          <div>
            <label for="reservation_date" class="block text-gray-700 font-medium mb-2">Reservation Date</label>
            <input type="date" name="reservation_date" id="reservation_date" class="border rounded-lg px-3 py-2 w-full" value="{{ request('reservation_date') }}">
          </div>
          <!-- Name -->
          <div>
            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter name..." class="border rounded-lg px-3 py-2 w-full" value="{{ request('name') }}">
          </div>
          <!-- Date Range -->
          <div>
            <label class="block text-gray-700 font-medium mb-2">Date Range</label>
            <div class="flex space-x-2">
              <input type="date" name="start_date" id="start_date" class="border rounded-lg px-3 py-2 w-full" value="{{ request('start_date') }}">
              <input type="date" name="end_date" id="end_date" class="border rounded-lg px-3 py-2 w-full" value="{{ request('end_date') }}">
            </div>
          </div>
        </div>
        <div class="mt-4 text-right">
          <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
            <i class="fas fa-filter mr-2"></i>
            Apply Filters
          </button>
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
            <th class="py-3 px-4 border-b">Full Tank</th>
            <th class="py-3 px-4 border-b">Franchise</th>
            <th class="py-3 px-4 border-b">Total Price</th>
            <th class="py-3 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
          @foreach ($reservations as $reservation)
            <tr class="hover:bg-gray-50 transition duration-150">
              <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
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
              <td class="py-2 px-4 border-b">{{ $reservation->full_tank ? 'Yes' : 'No' }}</td>
              <td class="py-2 px-4 border-b">{{ $reservation->franchise ? 'Yes' : 'No' }}</td>
              <td class="py-2 px-4 border-b">€{{ number_format($reservation->total_price, 2) }}</td>
              <td class="py-2 px-4 border-b text-center">
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
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

  @include('partials.footer')
</x-app-layout>

</body>
</html>
