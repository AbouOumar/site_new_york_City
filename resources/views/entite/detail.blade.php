<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $entite->nom }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar minimaliste -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">New York City</a>
            <ul class="flex space-x-6">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Accueil</a></li>
            </ul>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto py-24 px-4">
        <!-- Infos Entité -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold mb-2">{{ $entite->nom }}</h1>
            <p class="text-gray-600 mb-4">{{ $entite->description }}</p>
        </div>

        <!-- Sous-Entités -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($entite->subEntites as $sub)
                <div class="bg-white shadow rounded-lg overflow-hidden group hover:shadow-lg transition duration-300">
                    <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xl">
                        Image
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-bold group-hover:text-blue-600 transition duration-300">{{ $sub->nom }}</h2>
                        <p class="text-gray-600 mt-2">{{ Str::limit($sub->description, 100) }}</p>
                        <p class="text-sm text-gray-500 mt-1">Forfait : {{ $sub->forfait ?? 'N/A' }}</p>
                        <button class="mt-4 w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transform hover:scale-105 transition duration-300">
                            Réserver
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
