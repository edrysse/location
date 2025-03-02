<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Add New Car</h1>
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fuel">Fuel</label>
                <input type="text" name="fuel" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="seats">Seats</label>
                <input type="number" name="seats" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="luggage">Luggage</label>
                <input type="number" name="luggage" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ac">AC</label>
                <select name="ac" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="transmission">Transmission</label>
                <input type="text" name="transmission" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price_2_5_days">Price (2-5 Days)</label>
                <input type="number" step="0.01" name="price_2_5_days" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price_6_10_days">Price (6-10 Days)</label>
                <input type="number" step="0.01" name="price_6_10_days" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price_20_days">Price (20+ Days)</label>
                <input type="number" step="0.01" name="price_20_days" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
