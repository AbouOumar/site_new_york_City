@extends('layouts.app')

@section('title', 'Tableau de bord Super Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-10">

  <h1 class="text-3xl font-bold text-gray-900">Tableau de bord Super Admin</h1>

  <!-- Statistiques -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-md p-6 flex items-center space-x-4 hover:shadow-lg transition">
      <div class="bg-blue-200 text-blue-700 p-3 rounded-full">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21v-6a4 4 0 014-4h10a4 4 0 014 4v6"/></svg>
      </div>
      <div>
        <p class="text-sm font-medium text-blue-800">Hôtels</p>
        <p class="text-3xl font-extrabold text-blue-900">{{ $hotelsCount }}</p>
      </div>
    </div>

    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-md p-6 flex items-center space-x-4 hover:shadow-lg transition">
      <div class="bg-green-200 text-green-700 p-3 rounded-full">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a8.38 8.38 0 0113 0"/></svg>
      </div>
      <div>
        <p class="text-sm font-medium text-green-800">Utilisateurs</p>
        <p class="text-3xl font-extrabold text-green-900">{{ $utilisateursCount }}</p>
      </div>
    </div>
    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-md p-6 flex items-center space-x-4 hover:shadow-lg transition">
      <div class="bg-green-200 text-green-700 p-3 rounded-full">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a8.38 8.38 0 0113 0"/></svg>
      </div>
      <div>
        <p class="text-sm font-medium text-yellow-800">Entites</p>
        <p class="text-3xl font-extrabold text-green-900">{{ $entitesCount }}</p>
      </div>
    </div>
    

    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-md p-6 hover:shadow-lg transition">
      <p class="text-sm font-medium text-purple-800 mb-3">Hôtels par ville</p>
      <ul class="text-gray-700 space-y-1">
        @foreach($hotelsParVille as $ville => $count)
          <li class="flex justify-between">
            <span>{{ $ville }}</span>
            <span class="font-semibold">{{ $count }}</span>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="bg-gradient-to-br from-pink-100 to-purple-100 rounded-xl shadow-md p-6 hover:shadow-lg transition">
      <p class="text-sm font-medium text-purple-800 mb-3">Entités par hôtel</p>
      <ul class="text-gray-700 space-y-1">
        @foreach($entitesParHotel as $data)
    <li class="flex justify-between">
        <span>{{ $data['hotel_nom'] }}</span>
        <span class="font-semibold">{{ $data['count'] }}</span>
    </li>
@endforeach
      </ul>
    </div>
  </div>

  <!-- Derniers utilisateurs -->
  <section>
    <h2 class="text-xl font-semibold mb-4">Derniers utilisateurs</h2>
    <div class="overflow-x-auto bg-white rounded-xl shadow-md border border-gray-200">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-blue-200">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nom</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Rôle</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($utilisateursRecent as $utilisateur)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2">{{ $utilisateur->nom }}</td>
            <td class="px-4 py-2">{{ $utilisateur->email }}</td>
            <td class="px-4 py-2 capitalize">{{ $utilisateur->role->nom }}</td>
            <td class="px-4 py-2 space-x-2">
              <a href="{{ route('utilisateur.edit', $utilisateur->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
              <form action="{{ route('utilisateur.destroy', $utilisateur->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>

  <!-- Derniers hôtels -->
  <section>
    <h2 class="text-xl font-semibold mb-4 mt-8">Derniers hôtels</h2>
    <div class="overflow-x-auto bg-white rounded-xl shadow-md border border-gray-200">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-150">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nom</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Localité</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($hotelsRecent as $hotel)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2">{{ $hotel->nom }}</td>
            <td class="px-4 py-2">{{ $hotel->location }}</td>
            <td class="px-4 py-2 space-x-2">
              <a href="{{ route('hotels.edit', $hotel->id) }}" class="text-yellow-500 hover:underline">Modifier</a>
              <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet hôtel ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>

</div>
@endsection
