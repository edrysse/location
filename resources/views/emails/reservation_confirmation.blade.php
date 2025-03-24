<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('messages.reservation_confirmation_title') }}</title>
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
        <h1>{{ __('messages.thank_you_reservation') }}</h1>
        <p>{{ __('messages.hello_user', ['name' => $reservation->name]) }},</p>
        <p>{{ __('messages.reservation_sent_text') }}</p>
        <div class="details">
            <p><strong>{{ __('messages.car') }}:</strong> {{ $reservation->car_name }}</p>
            <p><strong>{{ __('messages.pickup_location') }}:</strong> {{ $reservation->pickup_location }}</p>
            <p><strong>{{ __('messages.dropoff_location') }}:</strong> {{ $reservation->dropoff_location }}</p>
            <p><strong>{{ __('messages.pickup_date') }}:</strong> {{ $reservation->pickup_date }}</p>
            <p><strong>{{ __('messages.return_date') }}:</strong> {{ $reservation->return_date }}</p>
        </div>
        <p>{{ __('messages.contact_us_text') }}</p>
        <p>{{ __('messages.best_regards') }},</p>
        <p>{{ __('messages.rental_team') }}</p>
        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="button">{{ __('messages.visit_website') }}</a>
        </div>
        <div class="footer">
            © {{ date('Y') }} {{ __('messages.site_name') }}. {{ __('messages.all_rights_reserved') }}
        </div>
    </div>
</body>
</html>
