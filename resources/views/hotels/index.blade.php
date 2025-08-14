@extends('layouts.app')

@section('title', 'Liste des Hôtels')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-extrabold text-gray-800">Liste des Hôtels</h2>
    <button onclick="openAddModal()"  
        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition-all text-white px-5 py-2.5 rounded-lg shadow-lg flex items-center space-x-2">
        <span class="text-lg">+</span> <span>Ajouter un hôtel</span>
    </button> 
</div>

{{-- Liste des hôtels --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($hotels as $hotel)
        <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden">
            <div class="p-5">
                <h3 class="text-xl font-bold text-gray-900">{{ $hotel->nom }}</h3>
                <p class="text-sm text-gray-500 mt-1 italic">{{ $hotel->location }}</p>
                <p class="text-gray-600 mt-3">{{ $hotel->description }}</p>
                
                <div class="mt-5 flex justify-between items-center">
                    <a href="{{ route('hotels.show', $hotel->id) }}" 
                        class="text-blue-600 font-medium hover:underline">Voir détails</a>
                    <div class="flex space-x-3">
                        <button onclick="openEditModal({{ $hotel }})" 
                            class="px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white text-sm">Modifier</button>
                        <button onclick="openDeleteModal({{ $hotel->id }}, '{{ addslashes($hotel->nom) }}')" 
                            class="px-3 py-1 rounded bg-red-500 hover:bg-red-600 text-white text-sm">Suspendre</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- MODALE AJOUT --}}
<div id="addHotelModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-8 relative transform scale-95 transition-transform duration-300">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Ajouter un hôtel</h3>

        <form action="{{ route('hotels.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom de l'hôtel</label>
                <input type="text" name="nom" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Localité</label>
                <input type="text" name="location" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="description" rows="4" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeAddModal()" 
                    class="px-5 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">Annuler</button>
                <button type="submit" 
                    class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg shadow-lg transition">Enregistrer</button>
            </div>
        </form>

        <button onclick="closeAddModal()" 
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
    </div>
</div>

{{-- MODALE EDIT --}}
<div id="editHotelModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-8 relative transform scale-95 transition-transform duration-300">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Modifier l'hôtel</h3>

        <form id="editHotelForm" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom de l'hôtel</label>
                <input id="edit_nom" type="text" name="nom" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Localité</label>
                <input id="edit_location" type="text" name="location" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea id="edit_description" name="description" rows="4" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeEditModal()" 
                    class="px-5 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">Annuler</button>
                <button type="submit" 
                    class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-lg transition">Modifier</button>
            </div>
        </form>

        <button onclick="closeEditModal()" 
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
    </div>
</div>

{{-- MODALE DELETE --}}
<div id="deleteHotelModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 relative transform scale-95 transition-transform duration-300">
        <h3 class="text-xl font-semibold mb-4 text-red-600">Confirmer la suspension</h3>
        <p id="deleteHotelName" class="mb-6 text-gray-700"></p>

        <form id="deleteHotelForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()" 
                    class="px-5 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">Annuler</button>
                <button type="submit" 
                    class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-lg transition">Suspendre</button>
            </div>
        </form>

        <button onclick="closeDeleteModal()" 
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
    // --- Ajout ---
    function openAddModal() {
        const modal = document.getElementById('addHotelModal');
        modal.classList.remove('hidden');
        setTimeout(() => modal.querySelector('div').classList.add('scale-100'), 10);
    }
    function closeAddModal() {
        const modal = document.getElementById('addHotelModal');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    // --- Edition ---
    function openEditModal(hotel) {
        const modal = document.getElementById('editHotelModal');
        const form = document.getElementById('editHotelForm');

        // Remplir les champs
        document.getElementById('edit_nom').value = hotel.nom;
        document.getElementById('edit_location').value = hotel.location;
        document.getElementById('edit_description').value = hotel.description;

        // Mettre à jour l'action du formulaire avec l'id
        form.action = `/hotels/${hotel.id}`;

        modal.classList.remove('hidden');
        setTimeout(() => modal.querySelector('div').classList.add('scale-100'), 10);
    }
    function closeEditModal() {
        const modal = document.getElementById('editHotelModal');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    // --- Suppression ---
    function openDeleteModal(hotelId, hotelName) {
        const modal = document.getElementById('deleteHotelModal');
        const form = document.getElementById('deleteHotelForm');
        const nameElem = document.getElementById('deleteHotelName');

        nameElem.textContent = `Voulez-vous vraiment supprimer l'hôtel "${hotelName}" ?`;
        form.action = `/hotels/${hotelId}`;

        modal.classList.remove('hidden');
        setTimeout(() => modal.querySelector('div').classList.add('scale-100'), 10);
    }
    function closeDeleteModal() {
        const modal = document.getElementById('deleteHotelModal');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }
</script>
@endsection
