<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Details - {{ $car->name }}</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">

  {{-- شريط التنقل --}}
  @include('partials.navbar')

  <div class="container mx-auto my-10 px-4">
    <div class="bg-white rounded-lg shadow p-6">
      <div class="flex flex-col md:flex-row items-center md:items-start">
        <!-- صورة السيارة -->
        <div class="w-full md:w-1/2">
          @if($car->image)
            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="w-full h-auto object-cover rounded-lg">
          @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
              <span class="text-gray-500">No Image Available</span>
            </div>
          @endif
        </div>
        <!-- تفاصيل السيارة -->
        <div class="w-full md:w-1/2 md:pl-8 mt-6 md:mt-0">
          <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $car->name }}</h2>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Fuel:</span> {{ $car->fuel }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Seats:</span> {{ $car->seats }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Luggage:</span> {{ $car->luggage }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">AC:</span> {{ $car->ac ? 'Yes' : 'No' }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Transmission:</span> {{ $car->transmission }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Location:</span> {{ $car->location }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Price/Day:</span> ${{ number_format($car->price, 2) }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Price 2-5 Days:</span> ${{ number_format($car->price_2_5_days, 2) }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Price 6-10 Days:</span> ${{ number_format($car->price_6_10_days, 2) }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Price 20 Days:</span> ${{ number_format($car->price_20_days, 2) }}</p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Franchise Price:</span>
            @if(isset($car->franchise_price))
              ${{ number_format($car->franchise_price, 2) }}
            @else
              N/A
            @endif
          </p>
          <p class="text-gray-600 mb-2"><span class="font-semibold">Available:</span> {{ $car->available ? 'Yes' : 'No' }}</p>
        </div>
      </div>

      <!-- أسعار المواسم -->
      @if($car->seasonPrices && $car->seasonPrices->count())
      <div class="mt-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Season Prices</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($car->seasonPrices as $season)
            <div class="border rounded-lg p-4 bg-gray-50 shadow-sm">
              <div class="flex justify-between items-center mb-2">
                <span class="font-bold text-gray-800">{{ $season->season_name }}</span>
                <span class="text-sm text-gray-600">
                  {{ date('Y-m-d', strtotime($season->start_date)) }} - {{ date('Y-m-d', strtotime($season->end_date)) }}
                </span>
              </div>
              <div class="text-gray-700">
                <p><span class="font-semibold">2-5 Days:</span> ${{ number_format($season->price_2_5_days, 2) }}</p>
                <p><span class="font-semibold">6-20 Days:</span> ${{ number_format($season->price_6_20_days, 2) }}</p>
                <p><span class="font-semibold">20+ Days:</span> ${{ number_format($season->price_20_plus_days, 2) }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      @endif

      <!-- زر العودة -->
      <div class="mt-8">
        <a href="{{ route('cars.index') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300">
          <i class="fas fa-arrow-left mr-2"></i> Back to Car List
        </a>
      </div>
    </div>
  </div>

  @include('partials.footer')
</body>
</html>
