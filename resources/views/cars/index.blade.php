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

  {{-- Navigation Bar --}}
  <x-app-layout>
    @include('partials.up')

    <div class="container mx-auto mt-12 px-6">
      <!-- Header Section -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Car List</h1>
      </div>

      <!-- Add New Car Button -->
      <div class="flex justify-end mb-6">
        <a href="{{ route('cars.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300">
          <i class="fas fa-plus mr-2"></i>
          Add New Car
        </a>
      </div>

      <!-- Filter Form Section -->
      <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('admin.cars.index') }}">
          <div class="flex flex-nowrap items-center gap-4 overflow-x-auto">
            <!-- Car Name -->
            <div class="flex-shrink-0 min-w-[150px]">
              <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
              <input
                type="text"
                name="name"
                class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-red-500 focus:outline-none focus:ring"
                placeholder="Search by name"
                value="{{ request('name') }}"
              >
            </div>

            <!-- Fuel -->
            <div class="flex-shrink-0 min-w-[150px]">
              <label for="fuel" class="block text-gray-700 font-medium mb-1">Carburant</label>
              <select
                name="fuel"
                class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-red-500 focus:outline-none focus:ring"
              >
                <option value="">Tous les types</option>
                <option value="essence" {{ request('fuel') == 'essence' ? 'selected' : '' }}>Essence</option>
                <option value="diesel" {{ request('fuel') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="electric" {{ request('fuel') == 'electric' ? 'selected' : '' }}>Électrique</option>
                <option value="hybrid" {{ request('fuel') == 'hybrid' ? 'selected' : '' }}>Hybride</option>
              </select>
            </div>

            <!-- Transmission -->
            <div class="flex-shrink-0 min-w-[150px]">
              <label for="transmission" class="block text-gray-700 font-medium mb-1">Transmission</label>
              <select
                name="transmission"
                class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-red-500 focus:outline-none focus:ring"
              >
                <option value="">All</option>
                @foreach(['Manual', 'Automatic'] as $trans)
                  <option value="{{ $trans }}" {{ request('transmission') == $trans ? 'selected' : '' }}>
                    {{ $trans }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Location -->
            <div class="flex-shrink-0 min-w-[150px]">
              <label for="location" class="block text-gray-700 font-medium mb-1">Location</label>
              <select
                name="location"
                class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-red-500 focus:outline-none focus:ring"
              >
                <option value="">All</option>
                <option value="Marrakech (Agence)" {{ request('location') == 'Marrakech (Agence)' ? 'selected' : '' }}>
                  Marrakech (Agence)
                </option>
                <option value="Marrakech medina" {{ request('location') == 'Marrakech medina' ? 'selected' : '' }}>
                  Marrakech Medina
                </option>
                <option value="Marrakech aéroport" {{ request('location') == 'Marrakech aéroport' ? 'selected' : '' }}>
                  Marrakech Airport
                </option>
              </select>
            </div>

            <!-- Apply Filters Button -->
            <div class="flex-shrink-0">
              <button
                type="submit"
                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700"
              >
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
              <th class="px-4 py-3">Location</th>
              <th class="px-4 py-3">Fuel</th>
              <th class="px-4 py-3">Transmission</th>
              <th class="px-4 py-3">Seats</th>
              <th class="px-4 py-3">{{ __('messages.kilometer') }}</th>
              <th class="px-4 py-3">{{ __('messages.price_per_day') }}</th>
              <th class="px-4 py-3">{{ __('messages.price_2_days') }}</th>
              <th class="px-4 py-3">{{ __('messages.price_3_7_days') }}</th>
              <th class="px-4 py-3">{{ __('messages.price_7_plus_days') }}</th>
              <th class="px-4 py-3">Franchise</th>
              <th class="px-4 py-3">{{ __('messages.franchise_buyback') }}</th>
              <th class="px-4 py-3">Available</th>
              <th class="px-4 py-3">Season Prices</th>
              <th class="px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cars as $car)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
              <!-- ID -->
              <td class="px-4 py-4">{{ $car->id }}</td>

              <!-- Image -->
              <td class="px-4 py-4">
                @if($car->image)
                  <!-- When clicking on the image, open the modal -->
                  <img
                    src="{{ asset( $car->image) }}"
                    alt="{{ $car->name }}"
                    class="w-28 h-28 object-contain rounded cursor-pointer mx-auto"
                    onclick="openImageModal('{{ asset( $car->image) }}')"
                    loading="lazy"
                  >
                @else
                  N/A
                @endif
              </td>

              <!-- Name -->
              <td class="px-4 py-4">{{ $car->name }}</td>
              <!-- Location -->
              <td class="px-4 py-4">{{ $car->location }}</td>
              <!-- Fuel -->
              <td class="px-4 py-4">{{ $car->fuel }}</td>
              <!-- Transmission -->
              <td class="px-4 py-4">{{ $car->transmission }}</td>
              <!-- Seats -->
              <td class="px-4 py-4">{{ $car->seats }}</td>
              <!-- Kilometer -->
              <td class="px-4 py-4">{{ $car->kilometer }}</td>
              <!-- Price/Day -->
              <td class="px-4 py-4">€{{ number_format($car->price, 2) }}</td>
              <!-- Price 2 Days -->
              <td class="px-4 py-4">€{{ number_format($car->price_2_days, 2) }}</td>
              <!-- Price 3-7 Days -->
              <td class="px-4 py-4">€{{ number_format($car->price_3_7_days, 2) }}</td>
              <!-- Price +7 Days -->
              <td class="px-4 py-4">€{{ number_format($car->price_7_plus_days, 2) }}</td>
              <!-- Franchise -->
              <td class="px-4 py-4">€{{ number_format($car->franchise_price, 2) }}</td>
              <!-- Franchise Buyback -->
              <td class="px-4 py-4">€{{ number_format($car->rachat_franchise_price, 2) }}</td>
              <!-- Available -->
              <td class="px-4 py-4">{{ $car->available ? 'Yes' : 'No' }}</td>
              <!-- Season Prices -->
              <td class="px-4 py-4">
                @if($car->seasonPrices && $car->seasonPrices->count())
                  @foreach($car->seasonPrices as $seasonPrice)
                    <button
                      onclick="showSeasonModal(
                        '{{ $seasonPrice->name }}',
                        '{{ $seasonPrice->price_2_days }}',
                        '{{ $seasonPrice->price_3_7_days }}',
                        '{{ $seasonPrice->price_7_plus_days }}',
                        '{{ $seasonPrice->start_date }}',
                        '{{ $seasonPrice->end_date }}'
                      )"
                      class="bg-blue-500 text-white px-3 py-2 rounded text-sm mb-2 hover:bg-blue-600 transition duration-300 block w-full text-center flex items-center justify-center"
                    >
                      <i class="fas fa-calendar-alt mr-2"></i>
                      {{ $seasonPrice->name }}
                    </button>
                  @endforeach
                @else
                  <span class="text-gray-500">-</span>
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

      <div>
        {{ $cars->links() }}
      </div>
    </div>

    <!-- Image Modal -->
    <div
      id="imageModal"
      class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 p-4"
      onclick="closeImageModal()"
    >
      <div
        class="bg-white rounded-lg overflow-hidden shadow-xl max-w-3xl w-full relative"
        onclick="event.stopPropagation()"
      >
        <!-- Close Button -->
        <div class="flex justify-end p-2">
          <button id="modalClose" class="text-gray-700 hover:text-gray-900 text-2xl" onclick="closeImageModal()">
            &times;
          </button>
        </div>
        <!-- Modal Content: Image -->
        <div class="p-4">
          <img id="modalImage" src="" alt="Car Image" class="w-full h-auto object-contain">
        </div>
      </div>
    </div>

    <!-- Season Modal -->
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
                <i class="fas fa-calendar-day text-red-500 mr-2"></i>
                <span class="font-semibold text-gray-700">Price (2 days):</span>
                <span class="ml-auto text-gray-800">€<span id="modalPrice2"></span></span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-calendar-week text-green-500 mr-2"></i>
                <span class="font-semibold text-gray-700">Price (3-7 days):</span>
                <span class="ml-auto text-gray-800">€<span id="modalPrice37"></span></span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                <span class="font-semibold text-gray-700">Price (+7 days):</span>
                <span class="ml-auto text-gray-800">€<span id="modalPrice7plus"></span></span>
              </div>
            </div>
          </div>
          <div class="px-6 py-4 flex justify-end">
            <button onclick="closeSeasonModal()" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

  {{-- Footer --}}
  @include('partials.footer')

  <!-- Scripts -->
  <script>
    /* ========== Image Modal ========== */
    function openImageModal(src) {
      const modal = document.getElementById('imageModal');
      const modalImage = document.getElementById('modalImage');
      modalImage.src = src;
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeImageModal() {
      const modal = document.getElementById('imageModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }

    /* ========== Season Modal ========== */
    function showSeasonModal(seasonName, price2, price37, price7plus, startDate, endDate) {
      document.getElementById('modalSeasonName').textContent = seasonName;
      document.getElementById('modalDates').textContent = `${startDate} - ${endDate}`;
      document.getElementById('modalPrice2').textContent = price2;
      document.getElementById('modalPrice37').textContent = price37;
      document.getElementById('modalPrice7plus').textContent = price7plus;

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
