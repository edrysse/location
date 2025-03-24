<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reservation Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #555555;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            padding: 20px;
        }
        h1 {
            color: #333333;
        }
        p {
            line-height: 1.6;
        }
        .details {
            margin: 20px 0;
            border-left: 3px solid #007BFF;
            background-color: #f9f9f9;
            padding: 10px 15px;
        }
        .details p {
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Reservation!</h1>
        <p>Hello {{ $reservation->name }},</p>
        <p>Your reservation has been confirmed with the following details:</p>
        <div class="details">
            <p><strong>Car:</strong> {{ $reservation->car_id }}</p>
            <p><strong>Pickup Location:</strong> {{ $reservation->pickup_location }}</p>
            <p><strong>Dropoff Location:</strong> {{ $reservation->dropoff_location }}</p>
            <p><strong>Pickup Date:</strong> {{ $reservation->pickup_date }}</p>
            <p><strong>Return Date:</strong> {{ $reservation->return_date }}</p>
        </div>
        <p>If you have any questions, please feel free to contact us.</p>
        <p>Best regards,</p>
        <p>The Car Rental Team</p>
        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="button">Visit Our Website</a>
        </div>
        <div class="footer">
            © {{ date('Y') }} Car Rental. All rights reserved.
        </div>
    </div>
</body>
</html>
