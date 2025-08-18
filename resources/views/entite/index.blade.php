@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Entités</h1>
        <button onclick="openModal('createModal')" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Nouvelle Entité
        </button>
    </div>

    <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Image</th>
                <th class="p-3 text-left">Nom</th>
                <th class="p-3 text-left">Hôtel</th>
                <th class="p-3 text-left">Type</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entites as $entite)
                <tr class="border-t">
                    <td class="p-3">
                        @if($entite->image)
                            <img src="{{ asset('storage/' . $entite->image) }}" class="w-16 h-16 object-cover rounded" alt="{{ $entite->nom }}">
                        @else
                            <img src="{{ asset('storage/entites/default-entite.jpg') }}" class="w-16 h-16 object-cover rounded" alt="Default">
                        @endif
                    </td>
                    <td class="p-3">{{ $entite->nom }}</td>
                    <td class="p-3">{{ $entite->hotel?->nom ?? '-' }}</td>
                    <td class="p-3">{{ $entite->type }}</td>
                    <td class="p-3">{{ $entite->description }}</td>
                    <td class="p-3 text-right space-x-2">
                        <button onclick="openEditModal({{ $entite->id }}, '{{ $entite->nom }}', '{{ $entite->description }}', {{ $entite->hotel_id }}, '{{ $entite->type }}')" 
                                class="text-yellow-500 hover:underline">Modifier</button>
                        <form action="{{ route('entites.destroy', $entite) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Supprimer cette entité ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODALE CRÉATION --}}
<div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Créer une Entité</h2>
        <form action="{{ route('entites.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Hôtel</label>
                <select name="hotel_id" class="w-full border rounded p-2">
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium">Type</label>
                <select name="type" class="w-full border rounded p-2">
                    <option value="Restaurant">Restaurant</option>
                    <option value="Boites">Boites</option>
                    <option value="Plein air">Plein air</option>
                    <option value="Piscine">Piscine</option>
                    <option value="Chambres">Chambres</option>
                </select>
            </div>
            <div>
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2"></textarea>
            </div>
            <div>
                <label class="block font-medium">Image</label>
                <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createModal')" class="px-4 py-2 bg-gray-300 rounded">Annuler</button>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

{{-- MODALE MODIFICATION --}}
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Modifier l'Entité</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-medium">Hôtel</label>
                <select name="hotel_id" id="editHotel" class="w-full border rounded p-2">
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium">Type</label>
                <select name="type" id="editType" class="w-full border rounded p-2">
                    <option value="Restaurant">Restaurant</option>
                    <option value="Boites">Boites</option>
                    <option value="Plein air">Plein air</option>
                    <option value="Piscine">Piscine</option>
                    <option value="Chambres">Chambres</option>
                </select>
            </div>
            <div>
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" id="editNom" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" id="editDescription" class="w-full border rounded p-2"></textarea>
            </div>
            <div>
                <label class="block font-medium">Image</label>
                <input type="file" name="image" id="editImage" accept="image/*" class="w-full border rounded p-2">
                <img id="currentImage" src="" class="w-32 h-32 object-cover mt-2 rounded" style="display:none;">
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
function openEditModal(id, nom, description, hotelId, type, image='') {
    document.getElementById('editNom').value = nom;
    document.getElementById('editDescription').value = description;
    document.getElementById('editHotel').value = hotelId;
    document.getElementById('editType').value = type;
    const img = document.getElementById('currentImage');
    if(image){
        img.src = '/storage/' + image;
        img.style.display = 'block';
    } else {
        img.style.display = 'none';
    }
    document.getElementById('editForm').action = `/entites/${id}`;
    openModal('editModal');
}
</script>
@endsection
