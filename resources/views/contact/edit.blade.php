<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Contact Message</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Edit Contact Message</h1>

    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md">
      <form action="{{ route('contact.update', $contact->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div>
          <label for="name" class="block text-gray-700 font-medium">Your Name</label>
          <input type="text" name="name" id="name" value="{{ $contact->name }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Email Field -->
        <div>
          <label for="email" class="block text-gray-700 font-medium">Your Email</label>
          <input type="email" name="email" id="email" value="{{ $contact->email }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Phone Field -->
        <div>
          <label for="phone" class="block text-gray-700 font-medium">Your Phone</label>
          <input type="text" name="phone" id="phone" value="{{ $contact->phone }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Subject Field -->
        <div>
          <label for="subject" class="block text-gray-700 font-medium">Subject</label>
          <input type="text" name="subject" id="subject" value="{{ $contact->subject }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Message Field -->
        <div>
          <label for="message" class="block text-gray-700 font-medium">Your Message</label>
          <textarea name="message" id="message" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>{{ $contact->message }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition-colors duration-300">
            <i class="fas fa-check mr-2"></i>Update Message
          </button>
        </div>
      </form>
    </div>
  </div>

  @include('partials.footer')
</body>
</html>
