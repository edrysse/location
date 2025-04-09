<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('messages.confirmation_title') }}</title>
  <!-- استخدام Tailwind CSS لستايل بسيط -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script>
    // عند تحميل الصفحة يتم فتح رابط واتساب في تبويب جديد
    document.addEventListener("DOMContentLoaded", function () {
      var waUrl = "{{ $waUrl }}";
      window.open(waUrl, '_blank');
    });
  </script>
</head>
<body>
  @include('partials.navbar')
  @include('partials.up')
  <div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md text-center">
      <h1 class="text-2xl font-bold mb-4">{{ __('messages.success_message') }}</h1>
      <p class="text-gray-600">{{ __('messages.wa_instruction') }}</p>
      <a href="{{ $waUrl }}" target="_blank" class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">
        {{ __('messages.open_whatsapp') }}
      </a>
      <p class="text-sm text-gray-500 mt-2">
        {{ __('messages.redirect_info') }}
      </p>
    </div>
  </div>
</body>
</html>
