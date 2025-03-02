<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmation</title>
</head>
<body>
    <h1>Reservation Confirmation</h1>
    <p>Thank you for your reservation. Here are the details:</p>
    <ul>
        @if ($reservation->car)
            <li>Car: {{ $reservation->car->name }}</li>
        @else
            <li>Car: Not available</li>
        @endif
        <li>Pickup Location: {{ $reservation->pickup_location }}</li>
        <li>Dropoff Location: {{ $reservation->dropoff_location }}</li>
        <li>Pickup Date: {{ $reservation->pickup_date }}</li>
        <li>Return Date: {{ $reservation->return_date }}</li>
        <li>Payment Method: {{ $reservation->payment_method }}</li> <!-- أضف هذا السطر -->
    </ul>
</body>
</html>
