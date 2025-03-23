<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reviews Management</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
<x-app-layout>
    @include('partials.up')

  <div class="container mx-auto mt-12 px-6 mb-16">
 
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Reviews Management</h1>
        <!-- زر إضافة ريفيو -->
        <a href="{{ route('reviews.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
            <i class="fas fa-plus mr-1"></i> Add Review
        </a>
    </div>
    <!-- Success Message -->
    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif

    <!-- Reviews Table Section -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Image</th>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Position</th>
            <th class="px-4 py-3">Comment</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reviews as $review)
            <tr class="border-b hover:bg-gray-50 transition duration-300">
              <td class="px-4 py-4">{{ $loop->iteration }}</td>
              <td class="px-4 py-4">
                @if($review->avatar)
                  <img src="{{ asset('storage/' . $review->avatar) }}" alt="Avatar" class="w-12 h-12 object-cover rounded-full">
                @else
                  <span>No image available</span>
                @endif
              </td>
              <td class="px-4 py-4">{{ $review->name }}</td>
              <td class="px-4 py-4">{{ $review->position }}</td>
              <td class="px-4 py-4">{{ $review->comment }}</td>
              <td class="px-4 py-4 flex gap-2">
                <a href="{{ route('admin.reviews.edit', $review->id) }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                  <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                    <i class="fas fa-trash mr-1"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mt-4">
      {{ $reviews->links() }}
    </div>
  </div>
  @include('partials.footer')
</x-app-layout>
</body>
</html>
