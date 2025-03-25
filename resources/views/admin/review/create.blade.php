<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Review</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <x-app-layout>
        @include('partials.up')

  <!-- Main Container -->
  <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h1 class="text-4xl font-bold text-gray-900">Add New Review</h1>
      <p class="text-gray-600 mt-2">Fill in the review details below</p>
    </div>

    <!-- Display Validation Errors -->
    @if ($errors->any())
      <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Success Message -->
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <!-- Add New Review Form -->
    <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <!-- Name Field -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-user mr-1"></i> Name
        </label>
        <input type="text" name="name" id="name" required
               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Position Field -->
      <div>
        <label for="position" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-briefcase mr-1"></i> Job Title
        </label>
        <input type="text" name="position" id="position" required
               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Comment Field -->
      <div>
        <label for="comment" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-comment mr-1"></i> Comment
        </label>
        <textarea name="comment" id="comment" required
                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Customer Image Field -->
      <div>
        <label for="avatar" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-image mr-1"></i> Customer Image
        </label>
        <input type="file" name="avatar" id="avatar"
               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Submit Button -->
      <div class="mt-8 flex justify-end">
        <button type="submit"
                class="px-8 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
          <i class="fas fa-plus mr-2"></i> Add Review
        </button>
      </div>
    </form>
  </div>

  @include('partials.footer')
</body>
</html>
