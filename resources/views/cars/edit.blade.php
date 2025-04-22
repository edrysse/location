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

  <!-- Main Container -->
  <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
    <!-- Header Section -->
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Edit Car</h1>

    <!-- Edit Car Form -->
    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 space-y-6">
      @csrf
      @method('PUT')

      <!-- Grid Form Fields -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Car Name -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Name</label>
          <input type="text" name="name" value="{{ old('name', $car->name) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <!-- Fuel -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Carburant</label>
          <select name="fuel" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
            <option value="">Sélectionner le type de carburant</option>
            <option value="essence" {{ old('fuel', $car->fuel) == 'essence' ? 'selected' : '' }}>Essence</option>
            <option value="diesel" {{ old('fuel', $car->fuel) == 'diesel' ? 'selected' : '' }}>Diesel</option>
            <option value="electric" {{ old('fuel', $car->fuel) == 'electric' ? 'selected' : '' }}>Électrique</option>
            <option value="hybrid" {{ old('fuel', $car->fuel) == 'hybrid' ? 'selected' : '' }}>Hybride</option>
          </select>
        </div>

        <!-- Doors -->
        <div class="mb-4">
            <label for="doors" class="block text-gray-700 font-semibold">{{ __('messages.doors') }}</label>
            <input type="number" min="2" max="7" name="doors" id="doors" value="{{ old('doors', $car->doors) }}" class="form-input mt-1 block w-full" required>
        </div>

        <!-- Bags -->
        <div class="mb-4">
            <label for="bags" class="block text-gray-700 font-semibold">{{ __('messages.bags') }}</label>
            <input type="number" min="1" max="8" name="bags" id="bags" value="{{ old('bags', $car->bags) }}" class="form-input mt-1 block w-full" required>
        </div>

        <!-- Seats -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Seats</label>
          <input type="number" name="seats" value="{{ old('seats', $car->seats) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <!-- Transmission -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Transmission</label>
          <select name="transmission" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
            <option value="">Select Transmission</option>
            <option value="manual" {{ old('transmission', $car->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
            <option value="automatic" {{ old('transmission', $car->transmission) == 'automatic' ? 'selected' : '' }}>Automatic</option>
          </select>
        </div>

        <!-- Price -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Price</label>
          <input type="number" step="0.01" name="price" value="{{ old('price', $car->price) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <!-- Price 2 Days -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Price (2 Days)</label>
          <input type="number" step="0.01" name="price_2_days" value="{{ old('price_2_days', $car->price_2_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <!-- Price 3-7 Days -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Price (3-7 Days)</label>
          <input type="number" step="0.01" name="price_3_7_days" value="{{ old('price_3_7_days', $car->price_3_7_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <!-- Price +7 Days -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Price (+7 Days)</label>
          <input type="number" step="0.01" name="price_7_plus_days" value="{{ old('price_7_plus_days', $car->price_7_plus_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <!-- Franchise Price -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Franchise Price</label>
          <input type="number" step="0.01" name="franchise_price" value="{{ old('franchise_price', $car->franchise_price) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Rachat Franchise Price -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Franchise Buyback Price</label>
          <input type="number" step="0.01" name="rachat_franchise_price" value="{{ old('rachat_franchise_price', $car->rachat_franchise_price) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Kilometer -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Kilometer</label>
          <input type="text" name="kilometer"  value="{{ old('kilometer', $car->kilometer) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>


        </div>

        <!-- Location -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Location</label>
          <select name="location" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500" required>
            <option value="">Select Location</option>
            <option value="Marrakech (Agence)" {{ old('location', $car->location) == 'Marrakech (Agence)' ? 'selected' : '' }}>Marrakech (Agency)</option>
            <option value="Marrakech medina" {{ old('location', $car->location) == 'Marrakech medina' ? 'selected' : '' }}>Marrakech Medina</option>
            <option value="Marrakech aéroport" {{ old('location', $car->location) == 'Marrakech aéroport' ? 'selected' : '' }}>Marrakech Airport</option>
          </select>
        </div>

        <!-- Image -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Image</label>
          @if($car->image)
            <div class="mt-2">
              <img src="{{ asset($car->image) }}" alt="{{ $car->name }}" class="w-32 h-32 object-cover rounded-lg">
            </div>
          @endif
          <input type="file" name="image" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Available -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Available</label>
          <select name="available" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
            <option value="1" {{ old('available', $car->available) ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !old('available', $car->available) ? 'selected' : '' }}>No</option>
          </select>
        </div>
      </div>

      <!-- Season Prices -->
      <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Season Prices</h2>
        <div id="seasonPricesContainer">
          @foreach($car->seasonPrices as $index => $seasonPrice)
            <div class="season-price-item bg-gray-50 p-6 rounded-lg mb-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Season Name -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Season Name</label>
                  <input type="text" name="season_prices[{{ $index }}][name]" value="{{ old('season_prices.'.$index.'.name', $seasonPrice->name) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                  <input type="hidden" name="season_prices[{{ $index }}][id]" value="{{ $seasonPrice->id }}">
                </div>

                <!-- Start Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Start Date</label>
                  <input type="date" name="season_prices[{{ $index }}][start_date]" value="{{ old('season_prices.'.$index.'.start_date', $seasonPrice->start_date ? $seasonPrice->start_date->format('Y-m-d') : '') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <!-- End Date -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">End Date</label>
                  <input type="date" name="season_prices[{{ $index }}][end_date]" value="{{ old('season_prices.'.$index.'.end_date', $seasonPrice->end_date ? $seasonPrice->end_date->format('Y-m-d') : '') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <!-- Season Prices -->
                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (2 Days)</label>
                  <input type="number" step="0.01" name="season_prices[{{ $index }}][price_2_days]" value="{{ old('season_prices.'.$index.'.price_2_days', $seasonPrice->price_2_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (3-7 Days)</label>
                  <input type="number" step="0.01" name="season_prices[{{ $index }}][price_3_7_days]" value="{{ old('season_prices.'.$index.'.price_3_7_days', $seasonPrice->price_3_7_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                  <label class="block text-lg font-medium text-gray-700">Price (+7 Days)</label>
                  <input type="number" step="0.01" name="season_prices[{{ $index }}][price_7_plus_days]" value="{{ old('season_prices.'.$index.'.price_7_plus_days', $seasonPrice->price_7_plus_days) }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
              </div>
              <button type="button" class="removeSeasonPrice mt-4 p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
            </div>
          @endforeach
        </div>
        <button type="button" id="addSeasonPrice" class="mt-4 p-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
          Add Season Price
        </button>
      </div>

      <button type="submit" class="w-full mt-6 p-3 bg-red-600 text-white text-xl font-semibold rounded-md hover:bg-red-700 transition duration-200">
        Update Car
      </button>
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
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (2 Days)</label>
            <input type="number" step="0.01" name="season_prices[\${seasonPriceIndex}][price_2_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (3-7 Days)</label>
            <input type="number" step="0.01" name="season_prices[\${seasonPriceIndex}][price_3_7_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Price (+7 Days)</label>
            <input type="number" step="0.01" name="season_prices[\${seasonPriceIndex}][price_7_plus_days]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-red-500">
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
