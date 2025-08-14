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
                <input type="text" name="numero_reservation" placeholder="Numéro de réservation" class="border rounded p-2" required>

                <!-- Sélection du service -->
                <select name="service_id" class="border rounded p-2" required>
                    <option value="">Sélectionner un service</option>
                    @foreach($subEntites as $subEntite)
                        <option value="{{ $subEntite->id }}">{{ $subEntite->nom }}</option>
                    @endforeach
                </select>

                <!-- Sélection de la sous-entité -->
                <select name="sub_service_id" class="border rounded p-2" required>
                    <option value="">Sélectionner une sous-entité</option>
                    @foreach($subEntites as $subEntite)
                        <option value="{{ $subEntite->id }}">{{ $subEntite->nom }}</option>
                    @endforeach
                </select>

                <input type="date" name="date_debut" class="border rounded p-2" required>
                <input type="date" name="date_fin" class="border rounded p-2" required>
                <input type="number" step="0.01" name="prix" placeholder="Prix" class="border rounded p-2" required>

                <select name="statut" class="border rounded p-2" required>
                    <option value="en_attente">En attente</option>
                    <option value="confirmee">Confirmée</option>
                    <option value="annulee">Annulée</option>
                </select>

                <div class="md:col-span-3">
                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                        Réserver
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des sous-entités -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Prix</th>
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
                            <td class="px-4 py-2 text-gray-600">{{ $sub->prix }} €</td>
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
