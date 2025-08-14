<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'New-York-City')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- l'entete de la page principale -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Gestion des Hôtels</h1>
            <nav class="space-x-4">
                <a href="{{ route('hotels.index') }}" class="text-gray-700 hover:text-blue-500">Hôtels</a>
                <a href="#" class="text-gray-700 hover:text-blue-500">Contact</a>
            </nav>
        </div>
    </header>
    <div class="flex min-h-screen bg-gray-100">
     @include('layouts.sidebar')

        <main class="container mx-auto px-4 py-6">
        @yield('content')
        </main>
    </div>

   

    <!-- Pieds de page -->
    <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} New-York-City-Hôtels. Tous droits réservés.
    </footer>
</body>
</html>
