<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Car</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <x-app-layout>
        @include('partials.up')

  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
      <strong>Errors:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Main Container -->
  <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
    <!-- Header Section -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-gray-900 text-center">Edit Car</h1>
      <p class="text-center text-gray-600 mt-2">Update the details of your car below</p>
    </div>

    <!-- Edit Car Form -->
    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="carForm">
      @csrf
      @method('PUT')

      <!-- Grid Form Fields -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Car Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-car-side mr-1"></i> Car Name
          </label>
          <input type="text" name="name" id="name" value="{{ $car->name }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Price -->
        <div>
          <label for="price" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-dollar-sign mr-1"></i> Price
          </label>
          <input type="number" step="0.01" name="price" id="price" value="{{ $car->price }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Fuel Type -->
        <div>
          <label for="fuel" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-gas-pump mr-1"></i> Fuel Type
          </label>
          <input type="text" name="fuel" id="fuel" value="{{ $car->fuel }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Seats -->
        <div>
          <label for="seats" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-users mr-1"></i> Seats
          </label>
          <input type="number" name="seats" id="seats" value="{{ $car->seats }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Luggage Capacity -->
        <div>
          <label for="luggage" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-suitcase-rolling mr-1"></i> Luggage Capacity
          </label>
          <input type="number" name="luggage" id="luggage" value="{{ $car->luggage }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Air Conditioning -->
        <div>
          <label for="ac" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-wind mr-1"></i> Air Conditioning
          </label>
          <select name="ac" id="ac" required
                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            <option value="1" {{ $car->ac ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$car->ac ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <!-- Transmission -->
        <div>
          <label for="transmission" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-exchange-alt mr-1"></i> Transmission
          </label>
          <input type="text" name="transmission" id="transmission" value="{{ $car->transmission }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Price (2-5 Days) -->
        <div>
          <label for="price_2_5_days" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-clock mr-1"></i> Price (2-5 Days)
          </label>
          <input type="number" step="0.01" name="price_2_5_days" id="price_2_5_days" value="{{ $car->price_2_5_days }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Price (6-10 Days) -->
        <div>
          <label for="price_6_10_days" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-clock mr-1"></i> Price (6-10 Days)
          </label>
          <input type="number" step="0.01" name="price_6_10_days" id="price_6_10_days" value="{{ $car->price_6_10_days }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Price (20+ Days) -->
        <div>
          <label for="price_20_days" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-clock mr-1"></i> Price (20+ Days)
          </label>
          <input type="number" step="0.01" name="price_20_days" id="price_20_days" value="{{ $car->price_20_days }}" required
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- location -->
        <select name="pickup_location" id="pickup_location" required
class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
<option value="" disabled selected>Select Location</option>
<option value="Marrakech (Agence)" {{ $car->location == 'Marrakech (Agence)' ? 'selected' : '' }}>Marrakech (Agence)</option>
<option value="Marrakech medina" {{ $car->location == 'Marrakech medina' ? 'selected' : '' }}>Marrakech medina</option>
<option value="Marrakech aéroport" {{ $car->location == 'Marrakech aéroport' ? 'selected' : '' }}>Marrakech aéroport</option>

</select>

        <!-- Available -->
        <div class="flex-1">
          <label for="available" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-check-circle mr-1"></i> Available
          </label>
          <select name="available" id="available" required
                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            <option value="1" {{ $car->available ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$car->available ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <!-- Car Image -->
        <div class="sm:col-span-2">
          <label for="image" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-image mr-1"></i> Car Image
          </label>
          <input type="file" name="image" id="image"
                 class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
          @if ($car->image)
            <div class="mt-4 flex items-center space-x-4">
              <img src="{{ asset( $car->image) }}" alt="{{ $car->name }}" class="rounded-lg w-40 h-40 object-cover shadow-md">
              <span class="text-gray-500 text-sm">Current Image</span>
            </div>
          @endif
        </div>
      </div>

      <!-- Section for Season Prices -->
      <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Season Prices</h2>
        <div id="seasonPricesContainer" class="space-y-6">
          @if($car->seasonPrices->count())
            @foreach($car->seasonPrices as $index => $season)
              <div class="season-price-item p-4 border border-gray-300 rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                  <!-- Season Name -->
                  <div>
                    <label class="block text-lg font-medium text-gray-700">Season Name</label>
                    <input type="text" name="season_prices[{{ $index }}][season_name]" value="{{ old("season_prices.$index.season_name", $season->season_name) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                  </div>
                  <!-- Start Date -->
                  <div>
                    <label class="block text-lg font-medium text-gray-700">Start Date</label>
                    <input type="date" name="season_prices[{{ $index }}][start_date]" value="{{ old("season_prices.$index.start_date", $season->start_date) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                  </div>
                  <!-- End Date -->
                  <div>
                    <label class="block text-lg font-medium text-gray-700">End Date</label>
                    <input type="date" name="season_prices[{{ $index }}][end_date]" value="{{ old("season_prices.$index.end_date", $season->end_date) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                  </div>
                  <!-- Price (2-5 Days) -->
                  <div>
                    <label class="block text-lg font-medium text-gray-700">Price (2-5 Days)</label>
                    <input type="number" step="0.01" name="season_prices[{{ $index }}][price_2_5_days]" value="{{ old("season_prices.$index.price_2_5_days", $season->price_2_5_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                  </div>
                  <!-- Price (6-20 Days) -->
                  <div>
                    <label class="block text-lg font-medium text-gray-700">Price (6-20 Days)</label>
                    <input type="number" step="0.01" name="season_prices[{{ $index }}][price_6_20_days]" value="{{ old("season_prices.$index.price_6_20_days", $season->price_6_20_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                  </div>
                  <!-- Price (20+ Days) -->
                  <div>
                    <label class="block text-lg font-medium text-gray-700">Price (20+ Days)</label>
                    <input type="number" step="0.01" name="season_prices[{{ $index }}][price_20_plus_days]" value="{{ old("season_prices.$index.price_20_plus_days", $season->price_20_plus_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                  </div>
                </div>
                <button type="button" class="removeSeasonPrice mt-4 p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
              </div>
            @endforeach
          @else
            <div class="season-price-item p-4 border border-gray-300 rounded-lg">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Season Name -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Season Name</label>
                  <input type="text" name="season_prices[0][season_name]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <!-- Start Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Start Date</label>
                  <input type="date" name="season_prices[0][start_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <!-- End Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">End Date</label>
                  <input type="date" name="season_prices[0][end_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <!-- Price (2-5 Days) -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (2-5 Days)</label>
                  <input type="number" step="0.01" name="season_prices[0][price_2_5_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <!-- Price (6-20 Days) -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (6-20 Days)</label>
                  <input type="number" step="0.01" name="season_prices[0][price_6_20_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <!-- Price (20+ Days) -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (20+ Days)</label>
                  <input type="number" step="0.01" name="season_prices[0][price_20_plus_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
              </div>
              <button type="button" class="removeSeasonPrice mt-4 p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
            </div>
          @endif
        </div>
        <button type="button" id="addSeasonPrice" class="mt-4 p-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
          Add Season Price
        </button>
      </div>

      <!-- Submit Button -->
      <div class="mt-8 flex justify-end">
        <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
          <i class="fas fa-save mr-2"></i> Update Car
        </button>
      </div>
    </form>
  </div>

  @include('partials.footer')

  <!-- JavaScript to handle dynamic Season Price fields and removal of empty blocks -->
  <script>
    // يتم تحديد الفهرس الابتدائي بناءً على عدد كتل أسعار الفصول الموجودة، أو 1 إن لم توجد
    let seasonPriceIndex = {{ $car->seasonPrices->count() ? $car->seasonPrices->count() : 1 }};
    document.getElementById('addSeasonPrice').addEventListener('click', function(){
      const container = document.getElementById('seasonPricesContainer');
      const div = document.createElement('div');
      div.classList.add('season-price-item', 'p-4', 'border', 'border-gray-300', 'rounded-lg');
      div.innerHTML = `
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="block text-lg font-medium text-gray-700">Season Name</label>
            <input type="text" name="season_prices[${seasonPriceIndex}][season_name]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Start Date</label>
            <input type="date" name="season_prices[${seasonPriceIndex}][start_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">End Date</label>
            <input type="date" name="season_prices[${seasonPriceIndex}][end_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (2-5 Days)</label>
            <input type="number" step="0.01" name="season_prices[${seasonPriceIndex}][price_2_5_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (6-20 Days)</label>
            <input type="number" step="0.01" name="season_prices[${seasonPriceIndex}][price_6_20_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (20+ Days)</label>
            <input type="number" step="0.01" name="season_prices[${seasonPriceIndex}][price_20_plus_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
        </div>
        <button type="button" class="removeSeasonPrice mt-4 p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
      `;
      container.appendChild(div);
      seasonPriceIndex++;
    });

    // عند إرسال النموذج، نقوم بفحص وإزالة الكتل الفارغة
    document.getElementById('carForm').addEventListener('submit', function(e) {
      const seasonItems = document.querySelectorAll(".season-price-item");
      seasonItems.forEach(item => {
        const inputs = item.querySelectorAll('input');
        let empty = true;
        inputs.forEach(input => {
          if(input.value.trim() !== '') {
            empty = false;
          }
        });
        if(empty) {
          item.remove();
        }
      });
    });

    // إزالة كتلة سعر الفصل عند الضغط على زر Remove
    document.addEventListener('click', function(e){
      if(e.target && e.target.classList.contains('removeSeasonPrice')){
        e.target.parentElement.remove();
      }
    });
  </script>
  </x-app-layout>

</body>
</html>
