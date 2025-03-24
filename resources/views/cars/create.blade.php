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
      <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 space-y-6" id="carForm">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <!-- Car Name -->
          <div>
            <label for="name" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-car-side mr-1"></i> Name
            </label>
            <input type="text" name="name" value="{{ old('name') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('name')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Fuel -->
          <div>
            <label for="fuel" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-gas-pump mr-1"></i> Fuel
            </label>
            <input type="text" name="fuel" value="{{ old('fuel') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('fuel')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Seats -->
          <div>
            <label for="seats" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-users mr-1"></i> Seats
            </label>
            <input type="number" name="seats" value="{{ old('seats') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('seats')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Luggage -->
          <div>
            <label for="luggage" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-suitcase-rolling mr-1"></i> Luggage
            </label>
            <input type="number" name="luggage" value="{{ old('luggage') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('luggage')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- AC -->
          <div>
            <label for="ac" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-wind mr-1"></i> AC
            </label>
            <select name="ac" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
              <option value="1" {{ old('ac') == '1' ? 'selected' : '' }}>Yes</option>
              <option value="0" {{ old('ac') == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('ac')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Transmission -->
          <div>
            <label for="transmission" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-exchange-alt mr-1"></i> Transmission
            </label>
            <input type="text" name="transmission" value="{{ old('transmission') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('transmission')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Price -->
          <div>
            <label for="price" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-dollar-sign mr-1"></i> Price
            </label>
            <input type="number" step="0.01" name="price" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          </div>

          <!-- Price (2-5 Days) -->
          <div>
            <label for="price_2_5_days" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-clock mr-1"></i> Price (2-5 Days)
            </label>
            <input type="number" step="0.01" name="price_2_5_days" value="{{ old('price_2_5_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('price_2_5_days')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Price (6-10 Days) -->
          <div>
            <label for="price_6_10_days" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-clock mr-1"></i> Price (6-10 Days)
            </label>
            <input type="number" step="0.01" name="price_6_10_days" value="{{ old('price_6_10_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('price_6_10_days')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Price (20+ Days) -->
          <div>
            <label for="price_20_days" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-clock mr-1"></i> Price (20+ Days)
            </label>
            <input type="number" step="0.01" name="price_20_days" value="{{ old('price_20_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('price_20_days')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Franchise Price -->
          <div>
            <label for="franchise_price" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-money-bill-wave mr-1"></i> Franchise Price
            </label>
            <input type="number" step="0.01" name="franchise_price" value="{{ old('franchise_price') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('franchise_price')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Full Tank Price -->
          <div>
            <label for="full_tank_price" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-gas-pump mr-1"></i> Full Tank Price
            </label>
            <input type="number" step="0.01" name="full_tank_price" value="{{ old('full_tank_price') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('full_tank_price')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Pickup Location -->
          <div>
            <label for="pickup_location" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-map-marker-alt mr-1"></i> Pickup Location
            </label>
            <select name="pickup_location" id="pickup_location" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
              <option value="" disabled selected>Select Location</option>
              <option value="Marrakech (Agence)">Marrakech (Agence)</option>
              <option value="Marrakech medina">Marrakech medina</option>
              <option value="Marrakech aéroport">Marrakech aéroport</option>
              <option value="Essaouira">Essaouira</option>
              <option value="Casablanca">Casablanca</option>
              <option value="Mohammedia">Mohammedia</option>
              <option value="Agadir">Agadir</option>
              <option value="Ouarzazate">Ouarzazate</option>
              <option value="Rabat">Rabat</option>
              <option value="Tanger">Tanger</option>
              <option value="Fès">Fès</option>
            </select>
            @error('pickup_location')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Available -->
          <div>
            <label for="available" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-check-circle mr-1"></i> Available
            </label>
            <select name="available" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
              <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>Yes</option>
              <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('available')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Image -->
          <div class="sm:col-span-2">
            <label for="image" class="block text-lg font-medium text-gray-700">
              <i class="fas fa-image mr-1"></i> Image
            </label>
            <input type="file" name="image" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('image')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- Section for Season Prices -->
        <div class="mt-8">
          <h2 class="text-2xl font-semibold text-gray-800 mb-4">Season Prices</h2>
          <div id="seasonPricesContainer" class="space-y-6">
            <!-- First Season Price Block -->
            <div class="season-price-item p-4 border border-gray-300 rounded-lg">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Season Name -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Season Name</label>
                  <input type="text" name="season_prices[0][season_name]" value="{{ old('season_prices.0.season_name') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <!-- Start Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Start Date</label>
                  <input type="date" name="season_prices[0][start_date]" value="{{ old('season_prices.0.start_date') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <!-- End Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">End Date</label>
                  <input type="date" name="season_prices[0][end_date]" value="{{ old('season_prices.0.end_date') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <!-- Price (2-5 Days) -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (2-5 Days)</label>
                  <input type="number" step="0.01" name="season_prices[0][price_2_5_days]" value="{{ old('season_prices.0.price_2_5_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <!-- Price (6-20 Days) -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (6-20 Days)</label>
                  <input type="number" step="0.01" name="season_prices[0][price_6_20_days]" value="{{ old('season_prices.0.price_6_20_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <!-- Price (20+ Days) -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (20+ Days)</label>
                  <input type="number" step="0.01" name="season_prices[0][price_20_plus_days]" value="{{ old('season_prices.0.price_20_plus_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
              </div>
              <button type="button" class="removeSeasonPrice mt-4 p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
            </div>
          </div>
          <button type="button" id="addSeasonPrice" class="mt-4 p-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
            Add Season Price
          </button>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full mt-6 p-3 bg-blue-600 text-white text-xl font-semibold rounded-md hover:bg-blue-700 transition duration-200">
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
        div.classList.add('season-price-item', 'p-4', 'border', 'border-gray-300', 'rounded-lg');
        div.innerHTML = `
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-lg font-medium text-gray-700">Season Name</label>
              <input type="text" name="season_prices[${seasonPriceIndex}][season_name]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-lg font-medium text-gray-700">Start Date</label>
              <input type="date" name="season_prices[${seasonPriceIndex}][start_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-lg font-medium text-gray-700">End Date</label>
              <input type="date" name="season_prices[${seasonPriceIndex}][end_date]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-lg font-medium text-gray-700">Price (2-5 Days)</label>
              <input type="number" step="0.01" name="season_prices[${seasonPriceIndex}][price_2_5_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-lg font-medium text-gray-700">Price (6-20 Days)</label>
              <input type="number" step="0.01" name="season_prices[${seasonPriceIndex}][price_6_20_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-lg font-medium text-gray-700">Price (20+ Days)</label>
              <input type="number" step="0.01" name="season_prices[${seasonPriceIndex}][price_20_plus_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
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
