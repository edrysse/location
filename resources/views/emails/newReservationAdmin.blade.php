<div style="text-align: center; margin-bottom: 20px;">
    <img src="'assets/diam-logo.png'" alt="{{ config('app.name') }} Logo" style="max-width: 200px;">
</div>

# New Reservation Received

A new reservation has been made with the following details:

<table style="width:100%; border-collapse: collapse; margin: 20px 0;">
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Name:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->name }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Email:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->email }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Phone:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->phone }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Car:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->car_name }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Pickup Location:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->pickup_location }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Dropoff Location:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->dropoff_location }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Pickup Date:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->pickup_date }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Return Date:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $reservation->return_date }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; background: #f7f7f7;"><strong>Total Price:</strong></td>
        <td style="padding: 8px; border: 1px solid #ddd;">${{ $reservation->total_price }}</td>
    </tr>
</table>

@component('mail::button', ['url' => route('reservations.show', $reservation->id)])
View Reservation
@endcomponent

Thanks,<br>
Admin Team
@endcomponent
