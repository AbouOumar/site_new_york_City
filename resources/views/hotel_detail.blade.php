<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hotel->nom }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Navbar élégante -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-2xl font-extrabold text-blue-700 tracking-wide hover:text-blue-800 transition">
                 New York City
            </a>
            <ul class="flex space-x-6 text-sm font-medium">
                <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition">Accueil</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-6xl mx-auto pt-24 pb-16 px-6">

        <!-- Carte Hôtel -->
        <section class="bg-white rounded-xl shadow-lg p-8 mb-10">
            <h1 class="text-4xl font-bold text-blue-700 mb-4">{{ $hotel->nom }}</h1>
            <p class="text-lg text-gray-700 mb-6 leading-relaxed">{{ $hotel->description }}</p>
            <div class="flex items-center text-gray-500 text-sm">
                <span class="mr-2">📍</span> {{ $hotel->location }}
            </div>
        </section>

        <!-- Liste des entités -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($hotel->entites as $entite)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    
                    {{-- Image de l'entité --}}
                    <div class="overflow-hidden h-48">
                        @if($entite->image)
                            <img src="{{ asset('storage/' . $entite->image) }}" alt="{{ $entite->nom }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/entites/default-entite.jpg') }}" alt="{{ $entite->nom }}" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-blue-600 mb-2">{{ $entite->nom }}</h2>
                        <p class="text-gray-700 mb-4">{{ $entite->description }}</p>
                        <p class="text-sm text-gray-500">
                            📌 Sous-espaces : <span class="font-medium">{{ $entite->subEntites->count() }}</span>
                        </p>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 text-right">
                        <a href="{{ route('entite.detail', $entite->id) }}"
                           class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Voir plus →
                        </a>
                    </div>
                </div>
            @endforeach
        </section>

    </main>

</body>
</html>
