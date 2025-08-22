@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Historique des ventes - SubEntité {{ $ventes->first()?->subEntite->nom ?? $subEntiteId }}</h1>

    @if($ventes->isEmpty())
        <p class="text-gray-600">Aucune vente enregistrée pour cette SubEntité.</p>
    @else
        <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">ID Vente</th>
                    <th class="p-3">Quantité</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Remise</th>
                    <th class="p-3">Net</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Créé le</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventes as $vente)
                <tr class="border-t">
                    <td class="p-3">{{ $vente->id }}</td>
                    <td class="p-3">{{ $vente->quantite }}</td>
                    <td class="p-3">{{ number_format($vente->total, 2, ',', ' ') }} GNF</td>
                    <td class="p-3">{{ number_format($vente->remise_globale, 2, ',', ' ') }} GNF</td>
                    <td class="p-3">{{ number_format($vente->net, 2, ',', ' ') }} GNF</td>
                    <td class="p-3">
                        @if($vente->status == 'soldé')
                            <span class="text-green-600 font-semibold">Soldé</span>
                        @else
                            <span class="text-red-600 font-semibold">Non payé</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
