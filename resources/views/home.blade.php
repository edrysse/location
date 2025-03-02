<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome to Car Rental</h1>

        <!-- عرض السيارات -->
        <div class="row">
            @foreach ($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->name }}</h5>
                        <p class="card-text">
                            <strong>Type:</strong> {{ $car->type }}<br>
                            <strong>Fuel:</strong> {{ $car->fuel }}<br>
                            <strong>Seats:</strong> {{ $car->seats }}<br>
                            <strong>Luggage:</strong> {{ $car->luggage }}<br>
                            <strong>AC:</strong> {{ $car->ac ? 'Yes' : 'No' }}<br>
                            <strong>Transmission:</strong> {{ $car->transmission }}<br>
                            <strong>Location:</strong> {{ $car->location }}<br>
                        </p>
                        <a href="{{ route('reservations.create', ['car_id' => $car->id]) }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
