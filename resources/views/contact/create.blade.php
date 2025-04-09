<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('messages.contact_us') }} | {{ __('messages.site_name') }}</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-red-50 to-red-100 min-h-screen">
  @include('partials.loader')
  @include('partials.navbar')
  @include('partials.up')

  <!-- Hero Section for Contact Page -->
  <section class="relative bg-cover bg-center h-64" style="background-image: url('/assets/contact-us.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="flex items-center justify-center h-full">
    </div>
  </section>

  <!-- Main Contact Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Contact Information -->
        <div class="space-y-6">
          <h2 class="text-3xl font-bold text-gray-800">{{ __('messages.get_in_touch') }}</h2>
          <p class="text-gray-600">{{ __('messages.contact_intro') }}</p>
          <div class="space-y-4">
            <div class="flex items-center">
              <i class="fas fa-map-marker-alt text-red-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">{{ __('messages.address_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.address_text') }}</p>
              </div>
            </div>
            <div class="flex items-center">
              <i class="fas fa-phone-alt text-red-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">{{ __('messages.phone_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.phone_text') }}</p>
              </div>
            </div>
            <div class="flex items-center">
              <i class="fas fa-envelope text-red-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">{{ __('messages.email_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.email_text') }}</p>
              </div>
            </div>
            <div class="flex items-center">
              <i class="fas fa-globe text-red-600 text-xl mr-4"></i>
              <div>
                <h3 class="text-xl font-medium text-gray-700">{{ __('messages.website_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.website_text') }}</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Contact Form -->
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ __('messages.send_message') }}</h2>
          <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="name" class="block text-gray-700 font-medium mb-2">
                {{ __('messages.your_name') }} <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" id="name" placeholder="{{ __('messages.name_placeholder') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div>
              <label for="email" class="block text-gray-700 font-medium mb-2">
                {{ __('messages.your_email') }} <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" id="email" placeholder="{{ __('messages.email_placeholder') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div>
              <label for="phone" class="block text-gray-700 font-medium mb-2">
                {{ __('messages.your_phone') }} <span class="text-red-500">*</span>
              </label>
              <input type="text" name="phone" id="phone" placeholder="{{ __('messages.phone_placeholder') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div>
              <label for="subject" class="block text-gray-700 font-medium mb-2">
                {{ __('messages.subject') }} <span class="text-red-500">*</span>
              </label>
              <input type="text" name="subject" id="subject" placeholder="{{ __('messages.subject_placeholder') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div>
              <label for="message" class="block text-gray-700 font-medium mb-2">
                {{ __('messages.your_message') }} <span class="text-red-500">*</span>
              </label>
              <textarea name="message" id="message" rows="5" placeholder="{{ __('messages.message_placeholder') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" required></textarea>
            </div>
            <div class="text-center">
              <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                <i class="fas fa-paper-plane mr-2"></i>{{ __('messages.send') }}
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
