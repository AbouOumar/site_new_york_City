<aside class="bg-white text-gray-800 w-64 flex-shrink-0 min-h-screen hidden md:flex flex-col shadow-lg">
    <!-- Logo -->
    <!-- <div class="flex items-center gap-2 px-6 py-5 border-b border-gray-200">
        <svg class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"/>
        </svg>
    </div> -->

    <!-- Menu -->
    <nav class="flex-1 px-3 py-6 space-y-2">
        <!-- Dashboard Admin Globale -->
        <a href="{{ route('dashboard.superadmin') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M3 12l2-2 4 4 8-8 4 4"></path></svg>
            Dashboard 
        </a>


        <!-- Gestion Utilisateurs (active) -->
        <a href="{{ route('utilisateurs.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gray-200 text-gray-900 font-medium">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M17 20h5V4H2v16h5m10 0v-6a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v6"></path></svg>
            Gestion Utilisateurs
        </a>

        <!-- Gestion Hôtellerie -->
        <a href="{{ route('hotels.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M3 9h18M3 5h18M3 19h18"></path></svg>
            Gestion Hôtellerie
        </a>

        <!-- Gestion Entité -->
        <a href="{{ route('entites.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M4 4h16v16H4z"></path></svg>
            Gestion Entité
        </a>

        <!-- Gestion des Sous Entités -->
        <a href="{{route('subentites.index')}}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            Gestion des Sous Entités
        </a>

        <!-- Gestion Ventes -->
        <a href="{{ route('ventes.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
            Gestion Ventes
        </a>
        <!-- Réservation -->
        <a href="{{ route('reservations.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4z"></path><path d="M6 20v-1a4 4 0 0 1 4-4h0a4 4 0 0 1 4 4v1"></path></svg>
            Réservation
        </a>
        <!-- Gestion Produits -->
        <a href="{{ route('produits.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M12 15l-3.5 2 1-4.5L6 9h4.5L12 4.5 13.5 9H18l-3.5 3.5 1 4.5z"></path></svg>
            Gestion Produits
        </a>
        <!-- Paramètres -->
        <a href="#" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24"><path d="M12 15l-3.5 2 1-4.5L6 9h4.5L12 4.5 13.5 9H18l-3.5 3.5 1 4.5z"></path></svg>
            Paramètres
        </a>
    </nav>
</aside>
