@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold text-center">Confirmation de réservation</h2>
    <div class="bg-white p-6 mt-6 rounded shadow-md">
        <p><strong>Voiture :</strong> {{ $data['car_id'] }}</p>
        <p><strong>Arrivée :</strong> {{ $data['pickup_date'] }}</p>
        <p><strong>Départ :</strong> {{ $data['return_date'] }}</p>
        <a href="{{ route('reservations.store', $data) }}" class="bg-green-600 text-white px-4 py-2 rounded mt-4 block text-center">Confirmer</a>
    </div>
</div>
@endsection
