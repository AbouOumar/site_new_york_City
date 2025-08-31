<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'New-York-City')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
    <!-- En-tête -->
    <header class="bg-gray-800 text-white shadow-lg">
        <div class="flex justify-between items-center px-6 py-4">
            <h1 class="text-xl font-bold tracking-wide">🏨 New York City Hôtels</h1>
            <nav class="space-x-6 hidden md:flex">
                <a href="#" class="hover:text-blue-400 transition">Comptes</a>
                <a href="#" class="hover:text-blue-400 transition">Profil</a>
                <a href="#" class="hover:text-blue-400 transition">Déconnexion</a>
            </nav>
            <!-- Menu mobile -->
            <button id="menu-button" class="md:hidden text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </header>

    <div class="flex flex-1">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Contenu principal -->
        <main class="flex-1 bg-gray-50 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- Pied de page -->
    <footer class="bg-gray-800 text-gray-300 py-4 text-center text-sm">
        &copy; {{ date('Y') }} <span class="font-semibold">New-York-City-Hôtels</span>. Tous droits réservés.
    </footer>
</body>
</html>
