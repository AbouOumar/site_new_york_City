@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Ventes par SubEntité</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($subEntites as $subEntite)
        <div class="bg-white shadow rounded-lg p-4 flex flex-col items-center">
            <h2 class="text-lg font-semibold mb-2">{{ $subEntite->nom }}</h2>

            <!-- Icône ventes non payées -->
            <a href="{{ route('ventes.nonPayes', $subEntite->id) }}" class="relative">
                <span class="material-icons text-red-500 text-4xl">Non solde</span>
                @if($subEntite->ventes_non_payees_count > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                        {{ $subEntite->ventes_non_payees_count }}
                    </span>
                @endif
            </a>
            <p class="text-sm mt-1">Non payées</p>

            <!-- Icône transfert -->
            <a href="{{ route('ventes.transfer', $subEntite->id) }}" class="mt-4">
                <span class="material-icons text-blue-500 text-4xl">Transférer</span>
            </a>
            <p class="text-sm">Transférer</p>

            <!-- Icône historique -->
            <a href="{{ route('ventes.historique', $subEntite->id) }}" class="mt-4">
                <span class="material-icons text-green-500 text-4xl">Historique</span>
            </a>
            <p class="text-sm">Historique</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
