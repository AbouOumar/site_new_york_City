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
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">New York City</a>
            <ul class="flex space-x-6">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors duration-300">Accueil</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero -->
    <section class="h-[50vh] flex items-center justify-center bg-cover bg-center relative group" 
             style="background-image: url('https://cdn.britannica.com/96/115096-050-5AFDAF5D/Bellagio-Hotel-Casino-Las-Vegas.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-60 transition duration-500"></div>
        <div class="relative p-8 rounded-lg text-center text-white transform group-hover:scale-105 transition duration-500">
            <h1 class="text-4xl font-bold mb-4">Bienvenue sur notre plateforme</h1>
            <p class="text-lg">Découvrez nos hôtels et réservez facilement en ligne.</p>
        </div>
    </section>

    <!-- Liste des Hôtels -->
    <div class="max-w-7xl mx-auto py-12 px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($hotels as $hotel)
            <div class="bg-white shadow rounded-lg overflow-hidden transform hover:-translate-y-2 hover:shadow-lg transition-all duration-500">
                <div class="overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?hotel,{{ $hotel->ville }}" 
                         alt="{{ $hotel->nom }}" 
                         class="w-full h-48 object-cover transform hover:scale-110 transition duration-500">
                </div>
<div class="bg-white shadow rounded-lg overflow-hidden transform hover:-translate-y-2 hover:shadow-lg transition-all duration-500">
    
    <!-- Image statique ou dynamique -->
    <div class="h-48 w-full bg-cover bg-center" 
         style="background-image: url('https://media.istockphoto.com/id/104731717/photo/luxury-resort.jpg?s=612x612&w=0&k=20&c=cODMSPbYyrn1FHake1xYz9M8r15iOfGz9Aosy9Db7mI=');">
         <!-- {{ $hotel->image ?? asset('images/default-hotel.jpg') }} la valeur de l'url doit être remplacée par ça -->
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
            </div>
        @endforeach
    </div>

</body>
</html>
