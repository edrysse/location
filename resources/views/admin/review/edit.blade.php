<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Review</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

  <!-- Main Container -->
  <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h1 class="text-4xl font-bold text-gray-900">Edit Review</h1>
      <p class="text-gray-600 mt-2">Update the review details below</p>
    </div>

    <!-- Display Validation Errors -->
    @if($errors->any())
      <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Edit Review Form -->
    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      <!-- Name Field -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-user mr-1"></i> Name
        </label>
        <input type="text" name="name" id="name" value="{{ $review->name }}" required
               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Position Field -->
      <div>
        <label for="position" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-briefcase mr-1"></i> Position
        </label>
        <input type="text" name="position" id="position" value="{{ $review->position }}" required
               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Comment Field -->
      <div>
        <label for="comment" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-comment mr-1"></i> Comment
        </label>
        <textarea name="comment" id="comment" required
                  class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $review->comment }}</textarea>
      </div>

      <!-- Avatar Field -->
      <div>
        <label for="avatar" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-image mr-1"></i> Avatar (Optional)
        </label>
        <input type="file" name="avatar" id="avatar"
               class="mt-2 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        @if($review->avatar)
          <div class="mt-4 flex items-center space-x-4">
            <img src="{{ asset('storage/' . $review->avatar) }}" alt="Avatar" class="w-24 h-24 object-cover rounded shadow">
            <span class="text-gray-500 text-sm">Current Avatar</span>
          </div>
        @endif
      </div>

      <!-- Action Buttons -->
      <div class="mt-8 flex justify-end gap-4">
        <button type="submit"
                class="px-8 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
          <i class="fas fa-save mr-2"></i> Save Changes
        </button>
        <a href="{{ route('admin.reviews.index') }}"
           class="px-8 py-3 bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all">
          <i class="fas fa-times mr-2"></i> Cancel
        </a>
      </div>
    </form>
  </div>

  @include('partials.footer')
</body>
</html>
