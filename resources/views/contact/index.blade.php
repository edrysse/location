<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Messages</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Contact Messages</h1>

    <!-- Table Section -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
      <table class="min-w-full">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Phone</th>
            <th class="px-4 py-3">Subject</th>
            <th class="px-4 py-3">Message</th>
            <th class="px-4 py-3">Date</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
          <tr class="border-b hover:bg-gray-50 transition duration-300">
            <td class="px-4 py-3">{{ $contact->id }}</td>
            <td class="px-4 py-3">{{ $contact->name }}</td>
            <td class="px-4 py-3">{{ $contact->email }}</td>
            <td class="px-4 py-3">{{ $contact->phone }}</td>
            <td class="px-4 py-3">{{ $contact->subject }}</td>
            <td class="px-4 py-3">
              <span class="message-preview">{{ \Illuminate\Support\Str::limit($contact->message, 50) }}</span>
              @if(strlen($contact->message) > 50)
                <a href="#" class="read-more text-blue-500 ml-2" onclick="toggleMessage({{ $contact->id }}); return false;">Read More</a>
                <span id="full-message-{{ $contact->id }}" class="full-message hidden">{{ $contact->message }}</span>
              @endif
            </td>
            <td class="px-4 py-3">{{ $contact->created_at->format('Y-m-d') }}</td>
            <td class="px-4 py-3 flex gap-2">
              <!-- Show Button -->
              <a href="{{ route('contact.show', $contact->id) }}" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition duration-300">
                <i class="fas fa-eye"></i>
              </a>
              <!-- Edit Button -->
              <a href="{{ route('contact.edit', $contact->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition duration-300">
                <i class="fas fa-edit"></i>
              </a>
              <!-- Delete Button -->
              <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 transition duration-300">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function toggleMessage(id) {
      var fullMessage = document.getElementById('full-message-' + id);
      if (fullMessage.classList.contains('hidden')) {
        fullMessage.classList.remove('hidden');
      } else {
        fullMessage.classList.add('hidden');
      }
    }
  </script>

  @include('partials.footer')
</body>
</html>
