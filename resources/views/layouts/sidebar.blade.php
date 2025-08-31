<aside class="bg-gradient-to-b from-slate-900 via-blue-900 to-indigo-900 text-white w-72 flex-shrink-0 min-h-screen hidden md:flex flex-col shadow-2xl border-r border-blue-800/30 relative overflow-hidden">
    
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" 
             style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), 
                                    radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);">
        </div>
    </div>

    <!-- Logo Section -->
    <div class="relative z-10 flex items-center gap-3 px-6 py-6 border-b border-blue-800/30 bg-black/20 backdrop-blur-sm">
        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg animate-pulse">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold bg-gradient-to-r from-blue-200 to-indigo-200 bg-clip-text text-transparent">
                Admin Panel
            </h1>
            <p class="text-xs text-blue-300">Gestion Hôtelière</p>
        </div>
    </div>

    <!-- Menu Navigation -->
    <nav class="relative z-10 flex-1 px-4 py-6 space-y-2 overflow-y-auto">

        <!-- Dashboard -->
        <a href="{{ route('dashboard.superadmin') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zM15 19V9a2 2 0 00-2-2h-2a2 2 0 00-2 2v10m8 0a2 2 0 002-2V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v14"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Dashboard</span>
        </a>

        <!-- Gestion Utilisateurs -->
        <a href="{{ route('utilisateurs.index') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl bg-gradient-to-r from-blue-600/80 to-indigo-600/80">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"/>
                </svg>
            </div>
            <span class="font-semibold text-white">Gestion Utilisateurs</span>
        </a>

        <!-- Gestion Hôtellerie -->
        <a href="{{ route('hotels.index') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9h18M3 5h18M3 19h18"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Gestion Hôtellerie</span>
        </a>

        <!-- Gestion Entité -->
        <a href="{{ route('entites.index') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 4h16v16H4z"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Gestion Entité</span>
        </a>

        <!-- Gestion Sous-Entités -->
        <a href="{{ route('subentites.index') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Sous Entités</span>
        </a>

        <!-- Gestion Ventes -->
        <a href="{{ route('ventes.index') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 8c-1.6 0-3 .9-3 2s1.4 2 3 2 3 .9 3 2-1.4 2-3 2"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Gestion Ventes</span>
        </a>

        <!-- Réservations -->
        <a href="{{ route('reservations.index') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Réservations</span>
        </a>

        <!-- Produits -->
        <a href="{{ route('produits.index') }}" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 7l-8-4-8 4v10l8 4 8-4z"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Produits</span>
        </a>

        <!-- Paramètres -->
        <a href="#" 
           class="group flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10 transition duration-300">
            <div class="w-10 h-10 bg-gradient-to-r from-gray-500 to-slate-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0"/>
                </svg>
            </div>
            <span class="font-medium text-blue-100 group-hover:text-white">Paramètres</span>
        </a>
    </nav>
</aside>
