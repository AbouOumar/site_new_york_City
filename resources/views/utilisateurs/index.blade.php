@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

  <!-- Titre et bouton -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Utilisateurs</h1>
    <button onclick="openModal()" 
      class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
      + Ajouter un utilisateur
    </button>
  </div>

  <!-- Tableau des utilisateurs -->
  <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Hôtel</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Rôle</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @foreach($utilisateurs as $utilisateur) 
          <tr>
            <td class="px-4 py-2">{{ $utilisateur->nom }}</td>
            <td class="px-4 py-2">{{ $utilisateur->email }}</td>
            <td class="px-4 py-2">{{ $utilisateur->hotel->nom }}</td>
            <td class="px-4 py-2 capitalize">{{ $utilisateur->role->nom }}</td>
            <td class="px-4 py-2 space-x-3">
              <a href="{{ route('utilisateur.edit', $utilisateur->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
              <form action="{{ route('utilisateur.destroy', $utilisateur->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Suspendre</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Fenêtre modale -->
<div id="modal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative animate-fadeIn">
    <h2 class="text-2xl font-bold mb-4">Ajouter un utilisateur</h2>

    <form action="{{ route('utilisateurs.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Nom -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="nom" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
      </div>

      <!-- Mot de passe -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" name="password" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
      </div>

      <!-- Rôle -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Rôle</label>
        <select name="role_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option value="">-- Sélectionner un rôle --</option>
          @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->nom }}</option>
          @endforeach
        </select>
      </div>

      <!-- Hôtel -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Hôtel</label>
        <select name="hotel_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          <option value="">-- Sélectionner un hôtel --</option>
          @foreach($hotels as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->nom }}</option>
          @endforeach
        </select>
      </div>

      <!-- Boutons -->
      <div class="flex justify-end space-x-3 pt-4">
        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Enregistrer</button>
      </div>
    </form>

    <!-- Bouton fermeture -->
    <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
      ✕
    </button>
  </div>
</div>

<!-- JS pour la modale -->
<script>
  function openModal() {
    document.getElementById('modal').classList.remove('hidden');
  }
  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
  }
</script>

<style>
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
  }
</style>
@endsection
