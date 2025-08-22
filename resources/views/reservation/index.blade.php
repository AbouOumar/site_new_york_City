@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Gestion des Réservations</h1>

    <!-- Champ de recherche -->
    <form method="GET" action="{{ route('reservations.index') }}" class="mb-4 flex gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Rechercher (client, téléphone, numéro, service...)" 
            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300"
        >
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
            Rechercher
        </button>
    </form>

    <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Client</th>
                <th class="p-3 text-left">Téléphone</th>
                <th class="p-3 text-left">Service</th>
                <th class="p-3 text-left">Numero de Reservation</th>
                <th class="p-3 text-left">Date début</th>
                <th class="p-3 text-left">Date fin</th>
                <th class="p-3 text-left" >Prix</th>
                <th class="p-3 text-left">Statut</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr class="border-t">
                <td class="p-3">{{ $reservation->nom_client }}</td>
                <td class="p-3">{{ $reservation->telephone_client }}</td>
                <td class="p-3">{{ $reservation->subEntite->nom ?? '-' }}</td>
                <td class="p-3">{{ $reservation->numero_reservation }}</td>
                <td class="p-3">{{ $reservation->date_debut }}</td>
                <td class="p-3">{{ $reservation->date_fin }}</td>
                <td class="p-3">{{ number_format($reservation->prix, 2, ',', ' ') }} GNF</td>
                <td class="p-3">
                    @if($reservation->statut == 'confirmé')
                        <span class="text-green-600 font-semibold">Confirmé</span>
                    @elseif($reservation->statut == 'annulé')
                        <span class="text-red-600 font-semibold">Annulé</span>
                    @else
                        <span class="text-yellow-600 font-semibold">En attente</span>
                    @endif
                </td>
                <td class="p-3 text-right space-x-2">
                    <form action="{{ route('reservations.updateStatus', [$reservation->id, 'confirmé']) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Confirmer</button>
                    </form>
                    <form action="{{ route('reservations.updateStatus', [$reservation->id, 'annulé']) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Annuler</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
