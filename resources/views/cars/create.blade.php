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
  @include('partials.navbar')

  <div class="max-w-4xl mx-auto mt-10 px-6">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Add New Car</h1>
    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 space-y-6">
      @csrf
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <!-- Car Name -->
        <div>
          <label for="name" class="block text-lg font-medium text-gray-700"><i class="fas fa-car-side mr-1"></i> Name</label>
          <input type="text" name="name" value="{{ old('name') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <!-- Type -->
                <!-- deleted -->


        <!-- Fuel -->
        <div>
          <label for="fuel" class="block text-lg font-medium text-gray-700"><i class="fas fa-gas-pump mr-1"></i> Fuel</label>
          <input type="text" name="fuel" value="{{ old('fuel') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('fuel')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Seats -->
        <div>
          <label for="seats" class="block text-lg font-medium text-gray-700"><i class="fas fa-users mr-1"></i> Seats</label>
          <input type="number" name="seats" value="{{ old('seats') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('seats')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Luggage -->
        <div>
          <label for="luggage" class="block text-lg font-medium text-gray-700"><i class="fas fa-suitcase-rolling mr-1"></i> Luggage</label>
          <input type="number" name="luggage" value="{{ old('luggage') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('luggage')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- AC -->
        <div>
          <label for="ac" class="block text-lg font-medium text-gray-700"><i class="fas fa-wind mr-1"></i> AC</label>
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
          <label for="transmission" class="block text-lg font-medium text-gray-700"><i class="fas fa-exchange-alt mr-1"></i> Transmission</label>
          <input type="text" name="transmission" value="{{ old('transmission') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('transmission')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Price -->
        <div>
          <label for="price" class="block text-lg font-medium text-gray-700"><i class="fas fa-dollar-sign mr-1"></i> Price</label>
          <input type="number" step="0.01" name="price" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Price (2-5 Days) -->
        <div>
          <label for="price_2_5_days" class="block text-lg font-medium text-gray-700"><i class="fas fa-clock mr-1"></i> Price (2-5 Days)</label>
          <input type="number" step="0.01" name="price_2_5_days" value="{{ old('price_2_5_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('price_2_5_days')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Price (6-10 Days) -->
        <div>
          <label for="price_6_10_days" class="block text-lg font-medium text-gray-700"><i class="fas fa-clock mr-1"></i> Price (6-10 Days)</label>
          <input type="number" step="0.01" name="price_6_10_days" value="{{ old('price_6_10_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('price_6_10_days')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Price (20+ Days) -->
        <div>
          <label for="price_20_days" class="block text-lg font-medium text-gray-700"><i class="fas fa-clock mr-1"></i> Price (20+ Days)</label>
          <input type="number" step="0.01" name="price_20_days" value="{{ old('price_20_days') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('price_20_days')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Location -->
        <div>
          <label for="location" class="block text-lg font-medium text-gray-700"><i class="fas fa-map-marker-alt mr-1"></i> Location</label>
          <input type="text" name="location" value="{{ old('location') }}" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          @error('location')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Available -->
        <div>
          <label for="available" class="block text-lg font-medium text-gray-700"><i class="fas fa-check-circle mr-1"></i> Available</label>
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
          <label for="image" class="block text-lg font-medium text-gray-700"><i class="fas fa-image mr-1"></i> Image</label>
          <input type="file" name="image" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
          @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full mt-6 p-3 bg-blue-600 text-white text-xl font-semibold rounded-md hover:bg-blue-700 transition duration-200">
        Submit
      </button>
    </form>
  </div>

  @include('partials.footer')
</body>
</html>
