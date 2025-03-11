<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car List</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

  <div class="container mx-auto mt-12 px-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Car List</h1>
    </div>

    <!-- Add New Car Button -->
    <div class="flex justify-end mb-6">
      <a href="{{ route('cars.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
        <i class="fas fa-plus mr-2"></i>
        Add New Car
      </a>
    </div>

    <!-- Filter Form Section -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
      <form method="GET" action="{{ route('cars.index') }}">
        <div class="flex flex-wrap items-center gap-4">
          <!-- Car Name -->
          <div class="flex-1 min-w-[150px]">
            <label for="name" class="block text-gray-700 font-medium mb-1">Car Name</label>
            <input type="text" name="name" id="name" placeholder="Search by name" class="border rounded-lg px-3 py-2 w-full" value="{{ request('name') }}">
          </div>
          <!-- Type -->
          <div class="flex-1 min-w-[150px]">
            <label for="type" class="block text-gray-700 font-medium mb-1">Type</label>
            <select name="type" id="type" class="border rounded-lg px-3 py-2 w-full">
              <option value="">All Types</option>
              <option value="Sedan" {{ request('type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
              <option value="SUV" {{ request('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
              <option value="Hatchback" {{ request('type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
            </select>
          </div>
          <!-- Fuel -->
          <div class="flex-1 min-w-[150px]">
            <label for="fuel" class="block text-gray-700 font-medium mb-1">Fuel</label>
            <select name="fuel" id="fuel" class="border rounded-lg px-3 py-2 w-full">
              <option value="">All Fuel Types</option>
              <option value="Petrol" {{ request('fuel') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
              <option value="Diesel" {{ request('fuel') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
              <option value="Electric" {{ request('fuel') == 'Electric' ? 'selected' : '' }}>Electric</option>
            </select>
          </div>
          <!-- AC -->
          <div class="flex-1 min-w-[150px]">
            <label for="ac" class="block text-gray-700 font-medium mb-1">AC</label>
            <select name="ac" id="ac" class="border rounded-lg px-3 py-2 w-full">
              <option value="">All</option>
              <option value="1" {{ request('ac') === "1" ? 'selected' : '' }}>Yes</option>
              <option value="0" {{ request('ac') === "0" ? 'selected' : '' }}>No</option>
            </select>
          </div>
          <!-- Transmission -->
          <div class="flex-1 min-w-[150px]">
            <label for="transmission" class="block text-gray-700 font-medium mb-1">Transmission</label>
            <select name="transmission" id="transmission" class="border rounded-lg px-3 py-2 w-full">
              <option value="">All</option>
              <option value="Automatic" {{ request('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
              <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
          </div>
          <!-- Location -->
          <div class="flex-1 min-w-[150px]">
            <label for="location" class="block text-gray-700 font-medium mb-1">Location</label>
            <select name="location" id="location" class="border rounded-lg px-3 py-2 w-full">
              <option value="">All</option>
              <option value="Marrakech" {{ request('location') == 'Marrakech' ? 'selected' : '' }}>Marrakech</option>
              <option value="Casablanca" {{ request('location') == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
              <option value="Rabat" {{ request('location') == 'Rabat' ? 'selected' : '' }}>Rabat</option>
            </select>
          </div>
          <!-- Apply Filters Button -->
          <div class="flex-shrink-0">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
              <i class="fas fa-filter mr-2"></i>
              Apply Filters
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Cars Table Section -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Fuel</th>
            <th class="px-4 py-3">Seats</th>
            <th class="px-4 py-3">Luggage</th>
            <th class="px-4 py-3">AC</th>
            <th class="px-4 py-3">Transmission</th>
            <th class="px-4 py-3">Location</th>
            <th class="px-4 py-3">Price/day</th>
            <th class="px-4 py-3">Image</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cars as $car)
          <tr class="border-b hover:bg-gray-50 transition duration-300">
            <td class="px-4 py-4">{{ $car->name }}</td>
            <td class="px-4 py-4">{{ $car->fuel }}</td>
            <td class="px-4 py-4">{{ $car->seats }}</td>
            <td class="px-4 py-4">{{ $car->luggage }}</td>
            <td class="px-4 py-4">{{ $car->ac ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-4">{{ $car->transmission }}</td>
            <td class="px-4 py-4">{{ $car->location }}</td>
            <td class="px-4 py-4">${{ number_format($car->price, 2) }}</td>
            <td class="px-4 py-4">
              @if($car->image)
              <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="w-16 h-16 object-cover rounded cursor-pointer" onclick="openModal('{{ asset('storage/' . $car->image) }}')">
              @else
              N/A
              @endif
            </td>
            <td class="px-4 py-4 flex gap-2">
              <a href="{{ route('cars.edit', $car->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600 transition duration-300">
                <i class="fas fa-edit mr-1"></i>
                Edit
              </a>
              <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition duration-300">
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

  <!-- Image Modal -->
  <div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-3xl w-full relative">
      <div class="flex justify-end p-2">
        <button id="modalClose" class="text-gray-700 hover:text-gray-900 text-2xl">&times;</button>
      </div>
      <div class="p-4">
        <img id="modalImage" src="" alt="Car Image" class="w-full h-auto object-contain">
      </div>
    </div>
  </div>

  <script>
    function openModal(src) {
      const modal = document.getElementById('imageModal');
      const modalImage = document.getElementById('modalImage');
      modalImage.src = src;
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
    document.getElementById('modalClose').addEventListener('click', function(){
      const modal = document.getElementById('imageModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    });
  </script>

  @include('partials.footer')
</body>
</html>
