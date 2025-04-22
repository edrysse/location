<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Car</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
  <x-app-layout>
    @include('partials.up')

    <div class="max-w-4xl mx-auto mt-10 px-6">
      <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Add New Car</h1>

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
          <strong class="font-bold">Validation Error</strong>
          <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
          <strong class="font-bold">Error!</strong>
          <p class="mt-2">{{ session('error') }}</p>
        </div>
      @endif

      <form action="{{ LaravelLocalization::localizeURL(route('cars.store') )}}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 space-y-6" id="carForm">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Car Name -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>

          <!-- Fuel -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Carburant</label>
            <select name="fuel" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
              <option value="">Sélectionner le type de carburant</option>
              <option value="essence" {{ old('fuel') == 'essence' ? 'selected' : '' }}>Essence</option>
              <option value="diesel" {{ old('fuel') == 'diesel' ? 'selected' : '' }}>Diesel</option>
              <option value="electric" {{ old('fuel') == 'electric' ? 'selected' : '' }}>Électrique</option>
              <option value="hybrid" {{ old('fuel') == 'hybrid' ? 'selected' : '' }}>Hybride</option>
            </select>
          </div>

          <!-- Doors -->
          <div class="mb-4">
            <label for="doors" class="block text-gray-700 font-semibold">{{ __('messages.doors') }}</label>
            <input type="number" min="2" max="7" name="doors" id="doors" value="{{ old('doors', 4) }}" class="form-input mt-1 block w-full" required>
          </div>

          <!-- Bags -->
          <div class="mb-4">
            <label for="bags" class="block text-gray-700 font-semibold">{{ __('messages.bags') }}</label>
            <input type="number" min="1" max="8" name="bags" id="bags" value="{{ old('bags', 2) }}" class="form-input mt-1 block w-full" required>
          </div>

          <!-- Seats -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Seats</label>
            <input type="number" name="seats" value="{{ old('seats') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>

          <!-- Transmission -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Transmission</label>
            <select name="transmission" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
              <option value="">Select Transmission</option>
              <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
              <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
            </select>
          </div>

          <!-- Price -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>

          <!-- Price 2 Days -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (2 Days)</label>
            <input type="number" step="0.01" name="price_2_days" value="{{ old('price_2_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>

          <!-- Price 3-7 Days -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (3-7 Days)</label>
            <input type="number" step="0.01" name="price_3_7_days" value="{{ old('price_3_7_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>

          <!-- Price +7 Days -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (+7 Days)</label>
            <input type="number" step="0.01" name="price_7_plus_days" value="{{ old('price_7_plus_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>

          <!-- Franchise Price -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Franchise Price</label>
            <input type="number" step="0.01" name="franchise_price" value="{{ old('franchise_price') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>

          <!-- Rachat Franchise Price -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Franchise Buyback Price</label>
            <input type="number" step="0.01" name="rachat_franchise_price" value="{{ old('rachat_franchise_price') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>

          <!-- Kilometer -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Kilometer</label>
            <input type="text" name="kilometer"  class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>

          <!-- Location -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Location</label>
            <select name="location" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
              <option value="">Select Location</option>
              <option value="Marrakech (Agence)" {{ old('location') == 'Marrakech (Agence)' ? 'selected' : '' }}>Marrakech (Agency)</option>
              <option value="Marrakech medina" {{ old('location') == 'Marrakech medina' ? 'selected' : '' }}>Marrakech Medina</option>
              <option value="Marrakech aéroport" {{ old('location') == 'Marrakech aéroport' ? 'selected' : '' }}>Marrakech Airport</option>
            </select>
          </div>

          <!-- Image -->
          <div>
            <label class="block text-lg font-medium text-gray-700">Image</label>
            <input type="file" name="image" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
          </div>
        </div>

        <!-- Section for Season Prices -->
        <div class="mt-8">
          <h2 class="text-xl font-semibold mb-4">Season Prices</h2>
          <div id="seasonPricesContainer">
            <div class="season-price-item bg-gray-50 p-6 rounded-lg mb-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Season Name -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Season Name</label>
                  <input type="text" name="season_prices[0][name]" value="{{ old('season_prices.0.name') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <!-- Start Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Start Date</label>
                  <input type="date" name="season_prices[0][start_date]" value="{{ old('season_prices.0.start_date') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <!-- End Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">End Date</label>
                  <input type="date" name="season_prices[0][end_date]" value="{{ old('season_prices.0.end_date') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <!-- Season Prices -->
                <div class="grid grid-cols-1 gap-4 mt-4">
                  <div>
                    <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_per_day') }}</label>
                    <input type="number" step="0.01" name="season_prices[0][price]" value="{{ old('season_prices.0.price') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
                  </div>
                  <div>
                    <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_2_days') }}</label>
                    <input type="number" step="0.01" name="season_prices[0][price_2_days]" value="{{ old('season_prices.0.price_2_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
                  </div>
                  <div>
                    <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_3_7_days') }}</label>
                    <input type="number" step="0.01" name="season_prices[0][price_3_7_days]" value="{{ old('season_prices.0.price_3_7_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
                  </div>
                  <div>
                    <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_7_plus_days') }}</label>
                    <input type="number" step="0.01" name="season_prices[0][price_7_plus_days]" value="{{ old('season_prices.0.price_7_plus_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
                  </div>
                </div>
              </div>
              <button type="button" class="removeSeasonPrice mt-4 p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
            </div>
          </div>
          <button type="button" id="addSeasonPrice" class="mt-4 p-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
            Add Season Price
          </button>
        </div>

        <button type="submit" class="w-full mt-6 p-3 bg-red-600 text-white text-xl font-semibold rounded-md hover:bg-red-700 transition duration-200">
          Submit
        </button>
      </form>
    </div>

    @include('partials.footer')

    <!-- JavaScript to handle dynamic Season Price fields and remove empty blocks on submit -->
    <script>
      let seasonPriceIndex = 1;

      document.getElementById('addSeasonPrice').addEventListener('click', function(){
        const container = document.getElementById('seasonPricesContainer');
        const div = document.createElement('div');
        div.classList.add('season-price-item', 'bg-gray-50', 'p-6', 'rounded-lg', 'mb-4');
        div.innerHTML = `
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-lg font-medium text-gray-700">Season Name</label>
              <input type="text" name="season_prices[\${seasonPriceIndex}][name]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>
            <div>
              <label class="block text-lg font-medium text-gray-700">Start Date</label>
              <input type="date" name="season_prices[\${seasonPriceIndex}][start_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>
            <div>
              <label class="block text-lg font-medium text-gray-700">End Date</label>
              <input type="date" name="season_prices[\${seasonPriceIndex}][end_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>
            <div class="grid grid-cols-1 gap-4 mt-4">
              <div>
                <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_per_day') }}</label>
                <input type="number" step="0.01" name="season_prices[\${seasonPriceIndex}][price]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
              </div>
              <div>
                <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_2_days') }}</label>
                <input type="number" step="0.01" name="season_prices[\${seasonPriceIndex}][price_2_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
              </div>
              <div>
                <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_3_7_days') }}</label>
                <input type="number" step="0.01" name="season_prices[\${seasonPriceIndex}][price_3_7_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
              </div>
              <div>
                <label class="block text-lg font-medium text-gray-700">{{ __('messages.season_price_7_plus_days') }}</label>
                <input type="number" step="0.01" name="season_prices[\${seasonPriceIndex}][price_7_plus_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
              </div>
            </div>
          </div>
          <button type="button" class="removeSeasonPrice mt-4 p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
        `;
        container.appendChild(div);
        seasonPriceIndex++;
      });

      // عند ارسال النموذج، نقوم بفحص وإزالة الكتل الفارغة
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
