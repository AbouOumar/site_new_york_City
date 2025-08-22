@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Catégories</h1>
        <button onclick="openModal('createModal')" 
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Nouvelle Catégorie
        </button>
    </div>

    <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Nom</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $categorie)
                <tr class="border-t">
                    <td class="p-3">{{ $categorie->nom }}</td>
                    <td class="p-3">{{ $categorie->description ?? '-' }}</td>
                    <td class="p-3 text-right space-x-2">
                        <button onclick="openEditModal(
                            {{ $categorie->id }},
                            '{{ $categorie->nom }}',
                            '{{ $categorie->description ?? '' }}'
                        )" class="text-yellow-500 hover:underline">Modifier</button>
                        <form action="{{ route('categories.delete', $categorie) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline"
                                onclick="return confirm('Supprimer cette catégorie ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODALE CRÉATION --}}
<div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
        <h2 class="text-xl font-bold mb-4">Créer une Catégorie</h2>
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2"></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createModal')" class="px-4 py-2 bg-gray-300 rounded">Annuler</button>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

{{-- MODALE MODIFICATION --}}
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
        <h2 class="text-xl font-bold mb-4">Modifier la Catégorie</h2>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" id="editName" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" id="editDescription" class="w-full border rounded p-2"></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-300 rounded">Annuler</button>
                <button class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
function openEditModal(id, nom, description) {
    document.getElementById('editName').value = nom;
    document.getElementById('editDescription').value = description;
    document.getElementById('editForm').action = `/categories/${id}`;
    openModal('editModal');
}
</script>
@endsection
