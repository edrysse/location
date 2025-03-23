<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terms & Conditions - Diamantina Car</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Tailwind Typography Plugin -->
  <script>
    tailwind.config = {
      theme: {
        extend: {},
      },
      plugins: [tailwindcssTypography],
    }
  </script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
    /* تنسيق للصور الدلالية */
    .section-icon {
      width: 40px;
      height: 40px;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
  @include('partials.navbar')
  @include('partials.up')

<!-- Hero Section: تصميم كامل الشاشة مع تأثير التدرج والنص المتحرك -->
<section class="relative h-screen overflow-hidden">
    <!-- الخلفية مع تراكب تدرجي -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/assets/hero-section.jpg');"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/90"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
      <h1 class="text-5xl md:text-6xl font-extrabold text-white drop-shadow-2xl animate-fadeInDown">
        GENERAL RENTAL CONDITIONS
      </h1>
      <p class="mt-6 text-lg md:text-xl text-gray-200 max-w-2xl animate-fadeInUp">
        Discover our transparent policies and seamless car rental experience that puts your safety and convenience first.
      </p>
    </div>
  </section>
  
  <!-- Content Section: محتوى مقسم إلى بطاقات عصرية مع أيقونات وتأثيرات تفاعلية -->
  <section class="container mx-auto my-16 px-4">
    <div class="grid gap-12 md:grid-cols-2">
      <!-- بطاقة القسم 1: Make Your Reservation -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/reserve.jpg" alt="Reservation">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-calendar-check text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Make Your Reservation</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Reserving a car with <strong>DIAMANTINACAR</strong> is simple and convenient. Book online or contact us directly for immediate confirmation.
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 2: Use of the Car -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/uses.jpg" alt="Use of the Car">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-car-side text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Use of the Car</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            The vehicle is solely for personal use by the tenant. Strictly no participation in competitions, illegal activities or overloading is allowed.
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 3: Condition & Liability -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/terms.jpg" alt="Condition & Liability">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-clipboard-list text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Condition & Liability</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Our vehicles are delivered in pristine condition. An inventory check is carried out upon delivery and return, ensuring full accountability.
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 4: Delivery / Collection -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/delevry.jpg" alt="Delivery and Collection">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-truck text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Delivery / Collection</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Choose your preferred delivery and pick-up location. In Marrakech, delivery and collection services are included in the rental price.
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 5: Fuel Policy -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/fuel.jpg" alt="Fuel Policy">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-gas-pump text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Fuel Policy</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Your vehicle is provided with a predetermined fuel level and must be returned similarly. Opt for a full tank during booking for added convenience.
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 6: Insurance -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/insurance.jpg" alt="Insurance">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-shield-alt text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Insurance</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Our fleet is fully insured against all risks. In the event of damage, a capped excess applies if liability is attributed to the driver.
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 7: Assistance -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0">
          <img class="w-full h-64 object-cover" src="/assets/accident.jpg" alt="Assistance">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-wrench text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Accident / Breakdown Assistance</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Round-the-clock assistance is available. In case of an accident or breakdown, contact our dedicated service team for prompt support and taxi arrangements.
          </p>
        </div>
      </article>
  
      <!-- بطاقة القسم 8: Payment / Deposit -->
      <article class="flex flex-col bg-white rounded-2xl shadow-2xl overflow-hidden transform transition hover:scale-105">
        <div class="flex-shrink-0 order-2 md:order-1">
          <img class="w-full h-64 object-cover" src="/assets/payment.jpg" alt="Payment / Deposit">
        </div>
        <div class="p-8 order-1 md:order-2">
          <div class="flex items-center mb-4">
            <div class="flex items-center justify-center bg-blue-600 text-white rounded-full w-12 h-12 mr-4">
              <i class="fas fa-credit-card text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Payment / Deposit</h2>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Payment is processed upon delivery. Options include cash, credit card or swift transfer. A security deposit is pre-authorized and released upon satisfactory return.
          </p>
        </div>
      </article>
    </div>
  </section>
  
  <!-- Custom Animations (يمكن إضافتها داخل ملف CSS خارجي أو داخل وسم <style>) -->
  <style>
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInDown {
      animation: fadeInDown 1s ease-out;
    }
    .animate-fadeInUp {
      animation: fadeInUp 1s ease-out;
    }
  </style>
  

  @include('partials.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
