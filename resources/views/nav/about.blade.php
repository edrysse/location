<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Diamantina Car</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
    @include('partials.loader')
    @include('partials.navbar')
    @include('partials.up')

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-96" style="background-image: url('/assets/about.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto h-full flex flex-col justify-center items-center relative z-10 px-4">
      <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4 text-center">About Us</h1>
      <p class="text-lg md:text-xl text-white text-center">Learn more about Diamantina Car</p>
    </div>
  </section>
  <!-- About Us Section -->
<section class="container mx-auto my-12 px-4">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- صورة لمراكش (يمكن استبدال الرابط بصورة حقيقية) -->
      <div class="md:w-1/2">
        <img src="/assets/location-voiture-marrakech-aeroport.jpg" loading="lazy" alt="Marrakech Airport" class="w-full h-auto rounded-lg shadow-lg">
      </div>
      <!-- المحتوى النصي -->
      <div class="md:w-1/2 text-center md:text-left">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Marrakech Airport Car Rental</h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          Marrakech Menara International Airport is the second largest airport in Morocco, handling over 4 million passengers annually.
          Our DIAMANTINA CAR rental service offers a seamless car booking experience at the airport. Upon arrival, our drivers are ready with your reserved car for a secure and comfortable trip.
        </p>
      </div>
    </div>
  </section>

  <!-- Car Rental Options -->
  <section class="container mx-auto my-12 px-4 bg-gray-50 py-8 rounded-lg shadow-lg">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- المحتوى النصي -->
      <div class="md:w-1/2 text-center md:text-left order-2 md:order-1">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Car Rental in Gueliz Marrakech</h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          Explore Marrakech and its beautiful surroundings with our premium rental vehicles. From the vibrant medina to the stunning Atlas Mountains,
          DIAMANTINA CAR ensures a hassle-free rental experience with top-notch customer service and competitive pricing.
        </p>
      </div>
      <!-- صورة لمراكش -->
      <div class="md:w-1/2 order-1 md:order-2">
        <img src="/assets/location-de-voiture-marrakech.jpg" loading="lazy" alt="Gueliz Marrakech" class="w-full h-auto rounded-lg shadow-lg">
      </div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- صورة لمراكش (مثلاً منظر ليلي أو مكان سياحي) -->
      <div class="md:w-1/2">
        <img src="/assets/diamantina-8.jpg" alt="Book Your Car" loading="lazy" class="w-full h-auto rounded-lg shadow-lg">
      </div>
      <!-- المحتوى النصي مع زر الحجز -->
      <div class="md:w-1/2 text-center md:text-left">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Book Your Car Now</h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          Secure your car rental today and enjoy the best rates with DIAMANTINA CAR. No hidden fees, 24/7 availability, and instant online reservations.
        </p>
        <div class="mt-6">
          <a href="/contact" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200">
            Book Now
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Who We Are Section -->
  <section class="container mx-auto my-12 px-4 bg-blue-50 py-8 rounded-lg shadow-lg">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- المحتوى النصي -->
      <div class="md:w-1/2 text-center md:text-left">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Who We Are</h2>
        <p class="text-gray-600 mt-4 leading-relaxed">
          Diamantina Car is a premier car rental service providing quality vehicles at competitive prices.
          Our mission is to make car rental simple, affordable, and hassle-free, ensuring you have the best experience in Marrakech.
        </p>
      </div>
      <!-- صورة لمراكش (مثلاً لقطة لشخص يستمتع بالتجوال) -->
      <div class="md:w-1/2">
        <img src="/assets/diam1.jpg" alt="Who We Are" loading="lazy" class="w-full h-auto rounded-lg shadow-lg">
      </div>
    </div>
  </section>

  <!-- Our Values -->
  <section class="container mx-auto my-12 px-4">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Our Values</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-handshake text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">Trust & Integrity</h3>
        <p class="text-gray-600">We believe in building long-term relationships with our clients based on honesty and trust.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-car text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">Quality Service</h3>
        <p class="text-gray-600">We provide top-notch customer service to ensure a seamless car rental experience.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <i class="fas fa-star text-blue-600 text-4xl mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">Customer Satisfaction</h3>
        <p class="text-gray-600">Your satisfaction is our top priority. We go the extra mile to meet your needs.</p>
      </div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section class="container mx-auto my-12 px-4 text-center">
    <h2 class="text-3xl font-bold text-gray-800">Get in Touch</h2>
    <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
      Have questions or need assistance? Our team is ready to help you.
    </p>
    <div class="mt-6">
      <a href="/contact" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
        Contact Us
      </a>
    </div>
  </section>

  @include('partials.footer')
</body>
</html>
