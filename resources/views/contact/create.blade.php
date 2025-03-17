<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

  <div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-8">Contact Us</h1>
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Your Name -->
        <div>
          <label for="name" class="block text-gray-700 font-medium">Your Name *</label>
          <input type="text" name="name" id="name" placeholder="Your full name" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Your Email -->
        <div>
          <label for="email" class="block text-gray-700 font-medium">Your Email *</label>
          <input type="email" name="email" id="email" placeholder="you@example.com" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Your Phone -->
        <div>
          <label for="phone" class="block text-gray-700 font-medium">Your Phone *</label>
          <input type="text" name="phone" id="phone" placeholder="+1 234 567 890" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Subject -->
        <div>
          <label for="subject" class="block text-gray-700 font-medium">Subject *</label>
          <input type="text" name="subject" id="subject" placeholder="Subject" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Your Message -->
        <div>
          <label for="message" class="block text-gray-700 font-medium">Your Message *</label>
          <textarea name="message" id="message" rows="5" placeholder="Type your message here..." class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow-md transition duration-300">
            <i class="fas fa-paper-plane mr-2"></i>Send Message
          </button>
        </div>
      </form>
    </div>
  </div>

  @include('partials.footer')
</body>
</html>
