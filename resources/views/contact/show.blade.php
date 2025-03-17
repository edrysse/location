<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Contact Message</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  @include('partials.navbar')

  <div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-8">View Contact Message</h1>

    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
      <div class="mb-4">
        <h2 class="text-xl font-bold text-gray-800">Message Details</h2>
      </div>
      <div class="space-y-4 text-gray-700">
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
        <p><strong>Subject:</strong> {{ $contact->subject }}</p>
        <p><strong>Message:</strong> {{ $contact->message }}</p>
        <p><strong>Submitted At:</strong> {{ $contact->created_at->format('Y-m-d H:i') }}</p>
      </div>
      <div class="mt-6">
        <a href="{{ route('contact.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition-colors duration-300">
          <i class="fas fa-arrow-left mr-2"></i> Back to Contacts
        </a>
      </div>
    </div>
  </div>

  @include('partials.footer')
</body>
</html>
