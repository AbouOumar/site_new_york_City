@extends('layouts.app')

@section('title', 'Ajouter un Hôtel')

@section('content')
<h2 class="text-2xl font-bold mb-4">Ajouter un Hôtel</h2>

<form action="{{ route('hotels.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block mb-1 font-medium">Nom de l'hôtel</label>
        <input type="text" name="name" class="w-full border border-gray-300 p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-medium">Description</label>
        <textarea name="description" class="w-full border border-gray-300 p-2 rounded" rows="4" required></textarea>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
</form>
@endsection
