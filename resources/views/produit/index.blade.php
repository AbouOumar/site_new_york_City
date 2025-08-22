@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Produits</h1>
         <button onclick="window.location.href='{{ route('categories.index') }}'"
                class="bg-indigo-400 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Ajouter une catégorie
        </button>
        <button onclick="openModal('createModal')" 
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Nouveau Produit
        </button>
    </div>

    <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Nom</th>
                <th class="p-3 text-left">Catégorie</th>
                <th class="p-3 text-left">Prix</th>
                <th class="p-3 text-left">Image</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $produit)
                <tr class="border-t">
                    <td class="p-3">{{ $produit->nom }}</td>
                    <td class="p-3">{{ $produit->categorie->nom ?? '' }}</td>
                    <td class="p-3">{{ number_format($produit->prix, 0, ',', ' ') }} FG</td>
                    <td class="p-3">
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" class="h-12 w-12 object-cover rounded">
                        @else
                            <img src="{{ asset('images/default.png') }}" class="h-12 w-12 object-cover rounded">
                        @endif
                    </td>
                    <td class="p-3 text-right space-x-2">
                        <button onclick="openEditModal(
                            {{ $produit->id }},
                            '{{ $produit->nom }}',
                            '{{ $produit->categorie_id }}',
                            '{{ $produit->prix }}'
                        )" class="text-yellow-500 hover:underline">Modifier</button>
                        <form action="{{ route('produits.delete', $produit) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline"
                                onclick="return confirm('Supprimer ce produit ?')">
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
        <h2 class="text-xl font-bold mb-4">Créer un Produit</h2>
        <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Catégorie</label>
                <select name="categorie_id" class="w-full border rounded p-2">
                    <option value="">-- Sélectionner une catégorie --</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium">Prix (FG)</label>
                <input type="number" name="prix" class="w-full border rounded p-2" min="0">
            </div>
            <div>
                <label class="block font-medium">Image</label>
                <input type="file" name="image" class="w-full border rounded p-2">
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
        <h2 class="text-xl font-bold mb-4">Modifier le Produit</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" id="editName" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Catégorie</label>
                <select name="categorie_id" id="editCategorie" class="w-full border rounded p-2">
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium">Prix (FG)</label>
                <input type="number" name="prix" id="editPrix" class="w-full border rounded p-2" min="0">
            </div>
            <div>
                <label class="block font-medium">Image (laisser vide pour ne pas changer)</label>
                <input type="file" name="image" class="w-full border rounded p-2">
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
function openEditModal(id, name, categorieId, prix) {
    document.getElementById('editName').value = name;
    document.getElementById('editCategorie').value = categorieId;
    document.getElementById('editPrix').value = prix;
    document.getElementById('editForm').action = `/produits/${id}`;
    openModal('editModal');
}
</script>
@endsection
