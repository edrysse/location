<!DOCTYPE html>
<html>
<head>
    <title>تأكيد الحجز</title>
</head>
<body>
    <h1>شكراً لك على حجزك!</h1>
    <p>مرحباً {{ $reservation->name }},</p>
    <p>تأكيد الحجز الخاص بك:</p>
    <p><strong>العربية:</strong> {{ $reservation->car_id }}</p>
    <p><strong>مكان الاستلام:</strong> {{ $reservation->pickup_location }}</p>
    <p><strong>مكان التسليم:</strong> {{ $reservation->dropoff_location }}</p>
    <p><strong>تاريخ الاستلام:</strong> {{ $reservation->pickup_date }}</p>
    <p><strong>تاريخ التسليم:</strong> {{ $reservation->return_date }}</p>
    <p>إذا كان لديك أي استفسارات، الرجاء التواصل معنا.</p>
    <p>مع تحياتنا،</p>
    <p>فريق تأجير السيارات</p>
</body>
</html>