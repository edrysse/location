<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Car List</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">

  {{-- شريط التنقل --}}
  <x-app-layout>
    @include('partials.up')

  <div class="container mx-auto mt-12 px-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Car List</h1>
    </div>

    <!-- Add New Car Button -->
    <div class="flex justify-end mb-6">
      <a href="{{ route('cars.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
        <i class="fas fa-plus mr-2"></i>
        Add New Car
      </a>
    </div>

    <!-- Filter Form Section -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
      <form method="GET" action="{{ route('cars.index') }}">
        <div class="flex flex-nowrap items-center gap-4 overflow-x-auto">
          <!-- Car Name -->
          <div class="flex-shrink-0 min-w-[150px]">
            <label for="name" class="block text-gray-700 font-medium mb-1">Car Name</label>
            <input
              type="text"
              name="name"
              id="name"
              placeholder="Search by name"
              class="border rounded-md px-3 py-2 w-full"
              value="{{ request('name') }}"
            >
          </div>
          <!-- Type -->
          <div class="flex-shrink-0 min-w-[150px]">
            <label for="type" class="block text-gray-700 font-medium mb-1">Type</label>
            <select name="type" id="type" class="border rounded-md px-3 py-2 w-full">
              <option value="">All Types</option>
              <option value="Sedan" {{ request('type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
              <option value="SUV" {{ request('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
              <option value="Hatchback" {{ request('type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
            </select>
          </div>
          <!-- Fuel -->
          <div class="flex-shrink-0 min-w-[150px]">
            <label for="fuel" class="block text-gray-700 font-medium mb-1">Fuel</label>
            <select name="fuel" id="fuel" class="border rounded-md px-3 py-2 w-full">
              <option value="">All Fuel Types</option>
              <option value="Petrol" {{ request('fuel') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
              <option value="Diesel" {{ request('fuel') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
              <option value="Electric" {{ request('fuel') == 'Electric' ? 'selected' : '' }}>Electric</option>
            </select>
          </div>
          <!-- AC -->
          <div class="flex-shrink-0 min-w-[150px]">
            <label for="ac" class="block text-gray-700 font-medium mb-1">AC</label>
            <select name="ac" id="ac" class="border rounded-md px-3 py-2 w-full">
              <option value="">All</option>
              <option value="1" {{ request('ac') === "1" ? 'selected' : '' }}>Yes</option>
              <option value="0" {{ request('ac') === "0" ? 'selected' : '' }}>No</option>
            </select>
          </div>
          <!-- Transmission -->
          <div class="flex-shrink-0 min-w-[150px]">
            <label for="transmission" class="block text-gray-700 font-medium mb-1">Transmission</label>
            <select name="transmission" id="transmission" class="border rounded-md px-3 py-2 w-full">
              <option value="">All</option>
              <option value="Automatic" {{ request('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
              <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
          </div>
          <!-- Location -->
          <div class="flex-shrink-0 min-w-[150px]">
            <label for="location" class="block text-gray-700 font-medium mb-1">Location</label>
            <select name="location" id="location" class="border rounded-md px-3 py-2 w-full">
              <option value="">All</option>
              <option value="Marrakech" {{ request('location') == 'Marrakech' ? 'selected' : '' }}>Marrakech</option>
              <option value="Casablanca" {{ request('location') == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
              <option value="Rabat" {{ request('location') == 'Rabat' ? 'selected' : '' }}>Rabat</option>
            </select>
          </div>
          <!-- Apply Filters Button -->
          <div class="flex-shrink-0">
            <button
              type="submit"
              class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 whitespace-nowrap"
            >
              <i class="fas fa-filter mr-2"></i>
              Apply Filters
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Cars Table Section -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-200 text-gray-700">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Image</th>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Fuel</th>
            <th class="px-4 py-3">Seats</th>
            <th class="px-4 py-3">Luggage</th>
            <th class="px-4 py-3">AC</th>
            <th class="px-4 py-3">Transmission</th>
            <th class="px-4 py-3">Location</th>
            <th class="px-4 py-3">Price/Day</th>
            <th class="px-4 py-3">Price 2-5 Days</th>
            <th class="px-4 py-3">Price 6-10 Days</th>
            <th class="px-4 py-3">Price 20 Days</th>
            <th class="px-4 py-3">Full tank</th>
            <th class="px-4 py-3">Franchise Price</th>
            <th class="px-4 py-3">Available</th>
            <th class="px-4 py-3">Season Prices</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cars as $car)
          <tr class="border-b hover:bg-gray-50 transition duration-300">
            <!-- ID -->
            <td class="px-4 py-4">{{ $car->id }}</td>

            <!-- Image -->
            <td class="px-4 py-4">
              @if($car->image)
                <!-- عند الضغط على الصورة، نفتح المودال -->
                <img
                  src="{{ asset('storage/' . $car->image) }}"
                  alt="{{ $car->name }}"
                  class="w-28 h-28 object-contain rounded cursor-pointer mx-auto"
                  onclick="openImageModal('{{ asset('storage/' . $car->image) }}')"
                  loading="lazy"
                >
              @else
                N/A
              @endif
            </td>

            <!-- Name -->
            <td class="px-4 py-4">{{ $car->name }}</td>
            <!-- Fuel -->
            <td class="px-4 py-4">{{ $car->fuel }}</td>
            <!-- Seats -->
            <td class="px-4 py-4">{{ $car->seats }}</td>
            <!-- Luggage -->
            <td class="px-4 py-4">{{ $car->luggage }}</td>
            <!-- AC -->
            <td class="px-4 py-4">{{ $car->ac ? 'Yes' : 'No' }}</td>
            <!-- Transmission -->
            <td class="px-4 py-4">{{ $car->transmission }}</td>
            <!-- Location -->
            <td class="px-4 py-4">{{ $car->location }}</td>
            <!-- Price/Day -->
            <td class="px-4 py-4">${{ number_format($car->price, 2) }}</td>
            <!-- Price 2-5 Days -->
            <td class="px-4 py-4">${{ number_format($car->price_2_5_days, 2) }}</td>
            <!-- Price 6-10 Days -->
            <td class="px-4 py-4">${{ number_format($car->price_6_10_days, 2) }}</td>
            <!-- Price 20 Days -->
            <td class="px-4 py-4">${{ number_format($car->price_20_days, 2) }}</td>
            <!-- Full tank -->
            <td class="px-4 py-4">
              @if(isset($car->full_tank_price))
                ${{ number_format($car->full_tank_price, 2) }}
              @else
                N/A
              @endif
            </td>
            <!-- Franchise Price -->
            <td class="px-4 py-4">
              @if(isset($car->franchise_price))
                ${{ number_format($car->franchise_price, 2) }}
              @else
                N/A
              @endif
            </td>
            <!-- Available -->
            <td class="px-4 py-4">{{ $car->available ? 'Yes' : 'No' }}</td>
            <!-- Season Prices -->
            <td class="px-4 py-4">
              @if($car->seasonPrices && $car->seasonPrices->count())
                <div class="flex flex-wrap gap-2">
                  @foreach($car->seasonPrices as $season)
                    <button
                      type="button"
                      class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 text-xs flex items-center"
                      onclick="showSeasonModal(
                        '{{ $season->season_name }}',
                        '{{ number_format($season->price_2_5_days, 2) }}',
                        '{{ number_format($season->price_6_20_days, 2) }}',
                        '{{ number_format($season->price_20_plus_days, 2) }}',
                        '{{ date('Y-m-d', strtotime($season->start_date)) }}',
                        '{{ date('Y-m-d', strtotime($season->end_date)) }}'
                      )"
                    >
                      <i class="fas fa-calendar-alt mr-1"></i>
                      {{ $season->season_name }}
                    </button>
                  @endforeach
                </div>
              @else
                N/A
              @endif
            </td>
            <!-- Actions (Edit & Delete) -->
            <td class="px-4 py-4 flex gap-2">
              <a
                href="{{ route('cars.edit', $car->id) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-300 text-sm flex items-center"
              >
                <i class="fas fa-edit mr-1"></i>
                Edit
              </a>
              <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button
                  type="submit"
                  class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm flex items-center"
                >
                  <i class="fas fa-trash mr-1"></i>
                  Delete
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- مودال عرض صورة السيارة -->
  <div
    id="imageModal"
    class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 p-4"
    onclick="closeImageModal()"
  >
    <div
      class="bg-white rounded-lg overflow-hidden shadow-xl max-w-3xl w-full relative"
      onclick="event.stopPropagation()" <!-- لمنع الإغلاق عند الضغط داخل المودال -->
    >
      <!-- زر الإغلاق -->
      <div class="flex justify-end p-2">
        <button id="modalClose" class="text-gray-700 hover:text-gray-900 text-2xl" onclick="closeImageModal()">
          &times;
        </button>
      </div>
      <!-- محتوى المودال: الصورة -->
      <div class="p-4">
        <img id="modalImage" src="" alt="Car Image" class="w-full h-auto object-contain">
      </div>
    </div>
  </div>

  <!-- مودال عرض تفاصيل الموسم -->
  <div id="seasonModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4" onclick="closeSeasonModal()">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md" onclick="event.stopPropagation()">
        <div class="bg-gray-100 px-6 py-4 rounded-t-lg">
          <h2 id="modalSeasonName" class="text-2xl font-bold text-gray-800"></h2>
          <p id="modalDates" class="text-sm text-gray-600"></p>
        </div>
        <div class="px-6 py-4">
          <div class="grid grid-cols-1 gap-4">
            <div class="flex items-center">
              <i class="fas fa-calendar-day text-blue-500 mr-2"></i>
              <span class="font-semibold text-gray-700">2-5 Days:</span>
              <span class="ml-auto text-gray-800">$<span id="modalPrice25"></span></span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-calendar-week text-green-500 mr-2"></i>
              <span class="font-semibold text-gray-700">6-20 Days:</span>
              <span class="ml-auto text-gray-800">$<span id="modalPrice620"></span></span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-calendar-alt text-red-500 mr-2"></i>
              <span class="font-semibold text-gray-700">20+ Days:</span>
              <span class="ml-auto text-gray-800">$<span id="modalPrice20plus"></span></span>
            </div>
          </div>
        </div>
        <div class="px-6 py-4 flex justify-end">
          <button onclick="closeSeasonModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
      {{ $cars->links() }}
  </div>

  {{-- شريط التذييل --}}
  @include('partials.footer')

  <!-- Scripts -->
  <script>
    /* ========== مودال الصورة ========== */
    function openImageModal(src) {
      const modal = document.getElementById('imageModal');
      const modalImage = document.getElementById('modalImage');
      modalImage.src = src;
      modal.classList.remove('hidden');
      modal.classList.add('flex'); // لجعل الحاوية flex للتمركز
    }

    function closeImageModal() {
      const modal = document.getElementById('imageModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }

    /* ========== مودال تفاصيل الموسم ========== */
    function showSeasonModal(seasonName, price25, price620, price20plus, startDate, endDate) {
      document.getElementById('modalSeasonName').textContent = seasonName;
      document.getElementById('modalDates').textContent = `${startDate} - ${endDate}`;
      document.getElementById('modalPrice25').textContent = price25;
      document.getElementById('modalPrice620').textContent = price620;
      document.getElementById('modalPrice20plus').textContent = price20plus;

      const modal = document.getElementById('seasonModal');
      modal.classList.remove('hidden');
    }

    function closeSeasonModal() {
      const modal = document.getElementById('seasonModal');
      modal.classList.add('hidden');
    }
  </script>
  </x-app-layout>

</body>
</html>
