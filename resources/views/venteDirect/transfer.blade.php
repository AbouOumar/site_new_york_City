@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Transférer des ventes - SubEntité {{ $subEntiteId }}</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($ventes->isEmpty())
        <p class="text-gray-600">Aucune vente non payée pour cette SubEntité.</p>
    @else
        <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">ID Vente</th>
                    <th class="p-3">Quantité</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Transférer vers</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventes as $vente)
                <tr class="border-t">
                    <td class="p-3">{{ $vente->id }}</td>
                    <td class="p-3">{{ $vente->quantite }}</td>
                    <td class="p-3">{{ number_format($vente->total, 2, ',', ' ') }} GNF</td>
                    <td class="p-3">
                        <form method="POST" action="{{ route('ventes.transfer', $vente->id) }}">
                            @csrf
                            <select name="nouvelle_sub_entite_id" class="border rounded p-1">
                                @foreach($autresSubEntites as $subEntite)
                                    <option value="{{ $subEntite->id }}">{{ $subEntite->nom }}</option>
                                @endforeach
                            </select>
                    </td>
                    <td class="p-3">
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Transférer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
