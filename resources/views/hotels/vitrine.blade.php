<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Hôtels</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">

    <div class="max-w-7xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold text-center mb-10">Nos Hôtels</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($hotels as $hotel)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?hotel,{{ $hotel->ville }}" alt="Image Hôtel" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $hotel->nom }}</h2>
                        <p class="text-gray-600 mb-3">{{ $hotel->description }}</p>
                        <span class="block text-sm text-gray-500 mb-4">📍 {{ $hotel->ville }}</span>
                        <a href="{{ url('/hotel/'.$hotel->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Voir Plus</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
