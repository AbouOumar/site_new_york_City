<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hotel->nom }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
     <!-- Navbar minimaliste -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">New York City</a>
            <ul class="flex space-x-6">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Accueil</a></li>
            </ul>
        </div>
    </nav>
    <div class="max-w-6xl mx-auto py-10 px-4">
        
        <!-- Infos Hôtel -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold mb-2">{{ $hotel->nom }}</h1>
            <p class="text-gray-600 mb-4">{{ $hotel->description }}</p>
            <span class="block text-gray-500 mb-2">📍 {{ $hotel->location }}</span>
        </div>

        <!-- Liste des entités -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($hotel->entites as $entite)
                <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Nom de l'entité -->
                    <div class="p-4">
                        <h2 class="text-xl font-bold mb-2">{{ $entite->nom }}</h2>
                        <p class="text-gray-600 mb-3">{{ $entite->description }}</p>
                        
                        <!-- Exemple infos supplémentaires -->
                        <p class="text-sm text-gray-500">
                            📌 Nombre de sous-espaces : {{ $entite->subEntites->count() }}
                        </p>
                    </div>

                    <!-- Bouton Voir plus -->
                    <div class="bg-gray-100 p-4 text-right">
                        <a href="{{ route('entite.detail', $entite->id) }}" 
                           class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Voir plus →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</body>
</html>
