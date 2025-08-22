<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-gray-300 shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <a href="{{ route('accueil') }}" class="text-2xl font-bold text-blue-600">New York City</a>
            <ul class="flex space-x-6">
                <li><a href="{{ route('accueil') }}" class="hover:text-blue-600 transition-colors duration-300">Accueil</a></li>
                <li><a href="#hotel-list" class="hover:text-blue-600 transition-colors duration-300">Nos Hotels</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero -->
<section x-data="{ index: 0, hotels: @json($hotels) }"
         x-init="setInterval(() => { index = (index + 1) % hotels.length }, 3000)"
         class="relative h-[50vh] w-full flex items-center justify-center overflow-hidden bg-gray-200">

    <!-- Images qui défilent -->
    <template x-for="(hotel, i) in hotels" :key="i">
        <div class="absolute inset-0 transition-opacity duration-1000"
             :class="{ 'opacity-0': i !== index, 'opacity-100': i === index }">
            <img :src="hotel.image ? '/storage/' + hotel.image : '/storage/hotels/default-hotel.jpg'" 
                 class="w-full h-full object-cover" alt="" />
        </div>
    </template>

    <!-- Overlay sombre -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <!-- Texte Bienvenue -->
    <div class="relative z-10 text-center text-white">
        <h1 class="text-4xl font-bold">Bienvenue</h1>
        <p class="text-lg mt-2">Découvrez nos hôtels et réservez facilement en ligne.</p>
    </div>
</section>

<!-- N’oublie pas d’inclure Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>

  
    <!-- Liste des Hôtels -->
    <div class="max-w-7xl mx-auto py-12 px-4 grid grid-cols-1 md:grid-cols-3 gap-8" id="hotel-list">
        @foreach($hotels as $hotel)
            
            <div class="bg-white shadow rounded-lg overflow-hidden transform hover:-translate-y-2 hover:shadow-lg transition-all duration-500">
                
                {{-- Image de l'hôtel --}}
                <div class="overflow-hidden h-48">
            @if($hotel->image)
                <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->nom }}">
            @else
                <img src="{{ asset('storage/hotels/default-hotel.jpg') }}" alt="{{ $hotel->nom }}">
            @endif

                </div>

                <div class="p-4">
                    <h2 class="text-xl font-semibold group-hover:text-blue-600 transition duration-300">
                        {{ $hotel->nom }}
                    </h2>
                    <p class="text-gray-600 mb-3">
                        {{ Str::limit($hotel->description, 100) }}
                    </p>
                    <span class="block text-sm text-gray-500">📍 {{ $hotel->location }}</span>
                    <a href="{{ route('hotels.detail', $hotel->id) }}" 
                       class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transform hover:scale-105 transition duration-300">
                        Voir plus
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <footer class="bg-gray-300 border-t py-4 text-center text-sm text-blue-500">
        &copy; {{ date('Y') }} New-York-City-Hôtels. Tous droits réservés.
    </footer>
</body>
</html>
