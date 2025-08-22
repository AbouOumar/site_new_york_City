@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Ventes non payées</h1>

    <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Client</th>
                <th class="p-3 text-left">Montant</th>
                <th class="p-3 text-left">Date</th>
                <th class="p-3 text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventes as $vente)
            <tr class="border-t">
                <td class="p-3">{{ $vente->subentites->nom }}</td>
                <td class="p-3">{{ number_format($vente->montant, 2, ',', ' ') }} GNF</td>
                <td class="p-3">{{ $vente->created_at->format('d/m/Y') }}</td>
                <td class="p-3 text-right">
                    <form action="{{ route('ventes.updateStatus', $vente->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Marquer payé</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-center text-gray-500">Aucune vente non payée</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
