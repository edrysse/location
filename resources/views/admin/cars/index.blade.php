@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-4 p-2 bg-gray-100 rounded text-right">
        <span class="font-bold">عدد الزوار:</span> {{ \App\Http\Controllers\CarController::countVisitors() }}
    </div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('messages.manage_cars') }}</h1>
        <a href="{{ route('cars.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-plus mr-2"></i>{{ __('messages.add_new_car') }}
        </a>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('admin.cars.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.car_name') }}</label>
                <input type="text" name="name" value="{{ request('name') }}" class="w-full rounded-md border-gray-300">
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.location') }}</label>
                <input type="text" name="location" value="{{ request('location') }}" class="w-full rounded-md border-gray-300">
            </div>
            <div>
                <label for="fuel" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.fuel_type') }}</label>
                <select name="fuel" class="w-full rounded-md border-gray-300">
                    <option value="">{{ __('messages.all') }}</option>
                    <option value="Diesel" {{ request('fuel') == 'Diesel' ? 'selected' : '' }}>{{ __('messages.diesel') }}</option>
                    <option value="Essence" {{ request('fuel') == 'Essence' ? 'selected' : '' }}>{{ __('messages.gasoline') }}</option>
                    <option value="Electric" {{ request('fuel') == 'Electric' ? 'selected' : '' }}>{{ __('messages.electric') }}</option>
                    <option value="Hybrid" {{ request('fuel') == 'Hybrid' ? 'selected' : '' }}>{{ __('messages.hybrid') }}</option>
                </select>
            </div>
            <div>
                <label for="transmission" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.transmission') }}</label>
                <select name="transmission" class="w-full rounded-md border-gray-300">
                    <option value="">{{ __('messages.all') }}</option>
                    <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>{{ __('messages.manual') }}</option>
                    <option value="Automatic" {{ request('transmission') == 'Automatic' ? 'selected' : '' }}>{{ __('messages.automatic') }}</option>
                </select>
            </div>
            <div>
                <label for="ac" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.air_conditioning') }}</label>
                <select name="ac" class="w-full rounded-md border-gray-300">
                    <option value="">{{ __('messages.all') }}</option>
                    <option value="1" {{ request('ac') == '1' ? 'selected' : '' }}>{{ __('messages.yes') }}</option>
                    <option value="0" {{ request('ac') == '0' ? 'selected' : '' }}>{{ __('messages.no') }}</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-search mr-2"></i>{{ __('messages.filter') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Cars Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.car') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.details') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.price') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.location') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cars as $car)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($car->image)
                                <img src="{{ asset($car->image) }}" alt="{{ $car->name }}" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-car text-gray-400"></i>
                                </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $car->name }}</div>
                                <div class="text-sm text-gray-500">ID: {{ $car->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            <div><i class="fas fa-gas-pump mr-2"></i>{{ $car->fuel }}</div>
                            <div><i class="fas fa-cogs mr-2"></i>{{ $car->transmission }}</div>
                            <div><i class="fas fa-snowflake mr-2"></i>{{ $car->ac ? __('messages.yes') : __('messages.no') }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            <div>{{ __('messages.base_price') }}: €{{ $car->price }}</div>
                            <div>{{ __('messages.2_days') }}: €{{ $car->price_2_days }}</div>
                            <div>{{ __('messages.3_7_days') }}: €{{ $car->price_3_7_days }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $car->location }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('cars.edit', $car->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $cars->links() }}
    </div>
</div>
@endsection
