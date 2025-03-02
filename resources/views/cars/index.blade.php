<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Car List</h1>
        <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Add New Car</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Fuel</th>
                    <th>Seats</th>
                    <th>Luggage</th>
                    <th>AC</th>
                    <th>Transmission</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->type }}</td>
                    <td>{{ $car->fuel }}</td>
                    <td>{{ $car->seats }}</td>
                    <td>{{ $car->luggage }}</td>
                    <td>{{ $car->ac ? 'Yes' : 'No' }}</td>
                    <td>{{ $car->transmission }}</td>
                    <td>{{ $car->location }}</td>
                    <td>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
