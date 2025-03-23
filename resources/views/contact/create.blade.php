<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us | Diamantina Car</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen">
  @include('partials.loader')
  @include('partials.navbar')
  @include('partials.up')

  <!-- Hero Section for Contact Page -->
  <section class="relative bg-cover bg-center h-64" style="background-image: url('/assets/contact-us.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>

  </section>

  <!-- Main Contact Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Contact Information -->
        <div class="space-y-6">
          <h2 class="text-3xl font-bold text-gray-800">Get in Touch</h2>
          <p class="text-gray-600">Feel free to contact us by filling out the form or through the details provided below. We look forward to hearing from you!</p>
          <div class="space-y-4">
            <div class="flex items-center">
              <i class="fas fa-map-marker-alt text-blue-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">Address</h3>
                <p class="text-gray-600">Angle Avenue 11 Janvier & Rue, Bd Prince Moulay Abdellah, Marrakech 40000</p>
              </div>
            </div>
            <div class="flex items-center">
              <i class="fas fa-phone-alt text-blue-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">Phone</h3>
                <p class="text-gray-600"> 06.61.06.03.62 | 06.60.56.57.30</p>
              </div>
            </div>
            <div class="flex items-center">
              <i class="fas fa-envelope text-blue-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">Email</h3>
                <p class="text-gray-600">contact@diamantinacar.com</p>
              </div>
            </div>
            <div class="flex items-center">
              <i class="fas fa-globe text-blue-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">Website</h3>
                <p class="text-gray-600">www.diamantinacar.com</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Contact Form -->
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
          <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="name" class="block text-gray-700 font-medium mb-2">
                Your Name <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" id="name" placeholder="Your full name" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
              <label for="email" class="block text-gray-700 font-medium mb-2">
                Your Email <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" id="email" placeholder="you@example.com" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
              <label for="phone" class="block text-gray-700 font-medium mb-2">
                Your Phone <span class="text-red-500">*</span>
              </label>
              <input type="text" name="phone" id="phone" placeholder="+1 234 567 890" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
              <label for="subject" class="block text-gray-700 font-medium mb-2">
                Subject <span class="text-red-500">*</span>
              </label>
              <input type="text" name="subject" id="subject" placeholder="Subject" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
              <label for="message" class="block text-gray-700 font-medium mb-2">
                Your Message <span class="text-red-500">*</span>
              </label>
              <textarea name="message" id="message" rows="5" placeholder="Type your message here..." class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="text-center">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                <i class="fas fa-paper-plane mr-2"></i>Send Message
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer')
</body>
</html>
