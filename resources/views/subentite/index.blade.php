@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Sous-Entités</h1>
        <button onclick="openModal('createModal')" 
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Nouvelle Sous-Entité
        </button>
    </div>

    <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Hotels</th>
                <th class="p-3 text-left">Nom</th>
                <th class="p-3 text-left">Entité</th>
                <th class="p-3 text-left">Prix</th>
                <th class="p-3 text-left">Image</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-left">Forfait</th>
                <th class="p-3 text-left">Nombre de places</th>
                <th class="p-3 text-left">Emplacement</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subEntites as $subEntite)
                <tr class="border-t">
                    <td class="p-3">{{ $subEntite->entite->hotel->nom ?? '' }}</td>
                    <td class="p-3">{{ $subEntite->nom }}</td>
                    <td class="p-3">{{ $subEntite->entite->nom ?? '' }}</td>
                    <td class="p-3">{{ $subEntite->prix ? number_format($subEntite->prix, 0, ',', ' ') . ' FCFA' : '-' }}</td>
                    <td class="p-3">
                        @if($subEntite->image)
                            <img src="{{ asset('storage/' . $subEntite->image) }}" class="h-12 w-12 object-cover rounded">
                        @else
                            <img src="{{ asset('images/default.png') }}" class="h-12 w-12 object-cover rounded">
                        @endif
                    </td>
                    <td class="p-3">{{ $subEntite->description }}</td>
                    <td class="p-3">{{ $subEntite->forfait }}</td>
                    <td class="p-3">{{ $subEntite->nombre_place }}</td>
                    <td class="p-3">{{ $subEntite->emplacement }}</td>
                    <td class="p-3 text-right space-x-2">
                        <button onclick="openEditModal(
                            {{ $subEntite->id }},
                            '{{ $subEntite->nom }}',
                            '{{ $subEntite->description }}',
                            '{{ $subEntite->entite->id }}',
                            '{{ $subEntite->forfait }}',
                            '{{ $subEntite->nombre_place }}',
                            '{{ $subEntite->emplacement }}',
                            '{{ $subEntite->prix }}'
                        )" class="text-yellow-500 hover:underline">Modifier</button>
                        <form action="{{ route('subentites.delete', $subEntite) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline"
                                onclick="return confirm('Supprimer cette sous-entité ?')">
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
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl">
        <h2 class="text-xl font-bold mb-4">Créer une Sous-Entité</h2>
        <form action="{{ route('subentites.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            {{-- Ligne 1 : Hôtel & Entité --}}
            <div class="md:flex md:gap-4">
                <div class="md:w-1/2">
                    <label class="block font-medium">Hôtel</label>
                    <select id="hotelSelect" name="hotel_id" class="w-full border rounded p-2">
                        <option value="">-- Sélectionner un hôtel --</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:w-1/2">
                    <label class="block font-medium">Entité</label>
                    <select id="entiteSelect" name="entite_id" class="w-full border rounded p-2" disabled>
                        <option value="">-- Sélectionner une entité --</option>
                    </select>
                </div>
            </div>

            {{-- Ligne 2 : Nom & Forfait --}}
            <div class="md:flex md:gap-4">
                <div class="md:w-1/2">
                    <label class="block font-medium">Nom</label>
                    <input type="text" name="nom" class="w-full border rounded p-2" required>
                </div>
                <div class="md:w-1/2">
                    <label class="block font-medium">Forfait</label>
                    <input type="text" name="forfait" class="w-full border rounded p-2">
                </div>
            </div>

            {{-- Ligne 3 : Prix & Nombre de places --}}
            <div class="md:flex md:gap-4">
                <div class="md:w-1/2">
                    <label class="block font-medium">Prix (FCFA)</label>
                    <input type="number" name="prix" class="w-full border rounded p-2">
                </div>
                <div class="md:w-1/2">
                    <label class="block font-medium">Nombre de places</label>
                    <input type="number" name="nombre_place" class="w-full border rounded p-2">
                </div>
            </div>

            {{-- Ligne 4 : Emplacement --}}
            <div>
                <label class="block font-medium">Emplacement</label>
                <input type="text" name="emplacement" class="w-full border rounded p-2">
            </div>

            {{-- Ligne 5 : Description --}}
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2"></textarea>
            </div>

            {{-- Ligne 6 : Image --}}
            <div>
                <label class="block font-medium">Image</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createModal')" class="px-4 py-2 bg-gray-300 rounded">Annuler</button>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

{{-- MODALE MODIFICATION --}}
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl">
        <h2 class="text-xl font-bold mb-4">Modifier la Sous-Entité</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Ligne 1 : Entité & Nom --}}
            <div class="md:flex md:gap-4">
                <div class="md:w-1/2">
                    <label class="block font-medium">Entité</label>
                    <select name="entite_id" id="editEntite" class="w-full border rounded p-2">
                        @foreach ($entites as $entite)
                            <option value="{{ $entite->id }}">{{ $entite->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:w-1/2">
                    <label class="block font-medium">Nom</label>
                    <input type="text" name="nom" id="editName" class="w-full border rounded p-2" required>
                </div>
            </div>

            {{-- Ligne 2 : Prix & Forfait --}}
            <div class="md:flex md:gap-4">
                <div class="md:w-1/2">
                    <label class="block font-medium">Prix (FCFA)</label>
                    <input type="number" name="prix" id="editPrix" class="w-full border rounded p-2">
                </div>
                <div class="md:w-1/2">
                    <label class="block font-medium">Forfait</label>
                    <input type="text" name="forfait" id="editForfait" class="w-full border rounded p-2">
                </div>
            </div>

            {{-- Ligne 3 : Nombre de places & Emplacement --}}
            <div class="md:flex md:gap-4">
                <div class="md:w-1/2">
                    <label class="block font-medium">Nombre de places</label>
                    <input type="number" name="nombre_place" id="editNombrePlace" class="w-full border rounded p-2">
                </div>
                <div class="md:w-1/2">
                    <label class="block font-medium">Emplacement</label>
                    <input type="text" name="emplacement" id="editEmplacement" class="w-full border rounded p-2">
                </div>
            </div>

            {{-- Ligne 4 : Description --}}
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" id="editDescription" class="w-full border rounded p-2"></textarea>
            </div>

            {{-- Ligne 5 : Image --}}
            <div>
                <label class="block font-medium">Image (laisser vide pour ne pas changer)</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>

            {{-- Boutons --}}
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
function openEditModal(id, name, description, entiteId, forfait, nombrePlace, emplacement, prix) {
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editEntite').value = entiteId;
    document.getElementById('editForfait').value = forfait;
    document.getElementById('editNombrePlace').value = nombrePlace;
    document.getElementById('editEmplacement').value = emplacement;
    document.getElementById('editPrix').value = prix;
    document.getElementById('editForm').action = `/subentites/${id}`;
    openModal('editModal');
}
document.getElementById('hotelSelect').addEventListener('change', function() {
    const hotelId = this.value;
    const entiteSelect = document.getElementById('entiteSelect');
    
    entiteSelect.innerHTML = '<option value="">-- Sélectionner une entité --</option>';
    entiteSelect.disabled = true;

    if (hotelId) {
        fetch(`/hotels/${hotelId}/entites`)
            .then(response => response.json())
            .then(data => {
                data.forEach(entite => {
                    const option = document.createElement('option');
                    option.value = entite.id;
                    option.textContent = entite.nom;
                    entiteSelect.appendChild(option);
                });
                entiteSelect.disabled = false;
            })
            .catch(err => console.error(err));
    }
});
</script>
@endsection
 