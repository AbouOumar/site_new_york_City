<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $entite->nom }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">New York City</a>
            <ul class="flex space-x-6">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Accueil</a></li>
            </ul>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto pt-24 px-4">

        <!-- Infos Entité -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <div class="overflow-hidden h-48">
                        @if($entite->image)
                            <img src="{{ asset('storage/' . $entite->image) }}" alt="{{ $entite->nom }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/entites/default-entite.jpg') }}" alt="{{ $entite->nom }}" class="w-full h-full object-cover">
                        @endif
                    </div>
            <h1 class="text-3xl font-bold mb-2">{{ $entite->nom }}</h1>
            <p class="text-gray-600">{{ $entite->description }}</p>
        </div>

       <!-- Formulaire de réservation -->
<div class="bg-white shadow-md rounded-lg p-6 mb-10">
    <h2 class="text-xl font-bold mb-4">Réserver une sous-entité</h2>
    <form action="{{ route('reservations.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @csrf
        <input type="text" name="nom_client" placeholder="Nom du client" class="border rounded p-2" required>
        <input type="text" name="telephone_client" placeholder="Téléphone" class="border rounded p-2" required>
        <input type="email" name="email_client" placeholder="Email" class="border rounded p-2" required>

        <!-- Service (fixé automatiquement) -->
        <input type="hidden" name="entite_id" value="{{ $entite->id }}"> 

        <!-- Choix de la sous-entité -->
        <select name="sub_entite_id" class="border rounded p-2" required>
            <option value="">Sélectionner une sous-entité</option>
            @forelse($entite->subEntites as $subEntite)
                <option value="{{ $subEntite->id }}">
                    {{ $subEntite->nom }} - {{ number_format($subEntite->prix, 0, ',', ' ') }} GNF
                </option>
            @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Aucune sous-entité disponible</td>
                        </tr>
            @endforelse
        </select>

        <input type="datetime-local" name="date_debut" class="border rounded p-2" required>
        <input type="datetime-local" name="date_fin" class="border rounded p-2" required>

        <!-- Le statut sera défini automatiquement côté back-end à "en_attente" -->
        <!-- Le prix est affiché directement avec la sous-entité -->

        <div class="md:col-span-3">
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Réserver
            </button>
        </div>
    </form>

    @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>


        <!-- Liste des sous-entités -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Prix</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Image</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Forfait</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Places</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Emplacement</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($entite->subEntites as $sub)
                        <tr>
                            <td class="px-4 py-2 font-medium text-gray-800">{{ $sub->nom }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $sub->prix }} FG</td>
                            <td class="px-4 py-2 text-gray-600">
                                @if($sub->image)
                                    <img src="{{ asset('storage/' . $sub->image) }}" class="h-12 w-12 object-cover rounded">
                                @else
                                    <img src="{{ asset('images/default.png') }}" class="h-12 w-12 object-cover rounded">
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-600">{{ $sub->forfait ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ Str::limit($sub->description, 50) }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $sub->nombre_place }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $sub->emplacement }}</td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Aucune sous-entité disponible</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
