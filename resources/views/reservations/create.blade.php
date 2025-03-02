<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create Reservation</h1>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="car_id" value="{{ request('car_id') }}">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pickup_location">Pickup Location</label>
                        <select name="pickup_location" class="form-control" required>
                            <option value="Marrakech Agency">Marrakech Agency</option>
                            <option value="Marrakech - Airport">Marrakech - Airport</option>
                            <option value="Essaouira">Essaouira</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Ouarzazate">Ouarzazate</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Fez">Fez</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dropoff_location">Dropoff Location</label>
                        <select name="dropoff_location" class="form-control" required>
                            <option value="Marrakech Agency">Marrakech Agency</option>
                            <option value="Marrakech - Airport">Marrakech - Airport</option>
                            <option value="Essaouira">Essaouira</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Ouarzazate">Ouarzazate</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Fez">Fez</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pickup_date">Pickup Date</label>
                        <input type="datetime-local" name="pickup_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="return_date">Return Date</label>
                        <input type="datetime-local" name="return_date" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" class="form-control" required>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                    <option value="online">Online Payment</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
