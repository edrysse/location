<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Car</h1>
        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $car->name }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" class="form-control" value="{{ $car->type }}" required>
            </div>
            <div class="form-group">
                <label for="fuel">Fuel</label>
                <input type="text" name="fuel" class="form-control" value="{{ $car->fuel }}" required>
            </div>
            <div class="form-group">
                <label for="seats">Seats</label>
                <input type="number" name="seats" class="form-control" value="{{ $car->seats }}" required>
            </div>
            <div class="form-group">
                <label for="luggage">Luggage</label>
                <input type="number" name="luggage" class="form-control" value="{{ $car->luggage }}" required>
            </div>
            <div class="form-group">
                <label for="ac">AC</label>
                <select name="ac" class="form-control" required>
                    <option value="1" {{ $car->ac ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$car->ac ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="transmission">Transmission</label>
                <input type="text" name="transmission" class="form-control" value="{{ $car->transmission }}" required>
            </div>
            <div class="form-group">
                <label for="price_2_5_days">Price (2-5 Days)</label>
                <input type="number" step="0.01" name="price_2_5_days" class="form-control" value="{{ $car->price_2_5_days }}" required>
            </div>
            <div class="form-group">
                <label for="price_6_10_days">Price (6-10 Days)</label>
                <input type="number" step="0.01" name="price_6_10_days" class="form-control" value="{{ $car->price_6_10_days }}" required>
            </div>
            <div class="form-group">
                <label for="price_20_days">Price (20+ Days)</label>
                <input type="number" step="0.01" name="price_20_days" class="form-control" value="{{ $car->price_20_days }}" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" class="form-control" value="{{ $car->location }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                @if ($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="img-thumbnail mt-2" width="150">
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
