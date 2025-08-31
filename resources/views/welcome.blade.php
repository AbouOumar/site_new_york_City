<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New York City Hotels - Luxe & Excellence</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 text-gray-800">

    <!-- Navbar -->
    <nav class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md border-b border-white/20 shadow-lg transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-20">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg">NYC</span>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    New York City Hotels
                </span>
            </div>
            <ul class="flex space-x-8">
                <li><a href="#hero" class="text-slate-700 hover:text-blue-600 font-medium transition-all duration-300">Accueil</a></li>
                <li><a href="#hotel-list" class="text-slate-700 hover:text-blue-600 font-medium transition-all duration-300">Nos Hôtels</a></li>
            </ul>
        </div>
    </nav>

    <section id="hero" 
             x-data="{ 
                 index: 0, 
                 hotels: [
                     {
                         nom: 'The Manhattan Grand',
                         image: 'https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg?auto=compress&cs=tinysrgb&w=1200',
                         location: 'Central Park, Manhattan'
                     },
                     {
                         nom: 'Brooklyn Heights Boutique',
                         image: 'https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg?auto=compress&cs=tinysrgb&w=1200',
                         location: 'Brooklyn Heights, Brooklyn'
                     },
                     {
                         nom: 'Times Square Luxury',
                         image: 'https://images.pexels.com/photos/338504/pexels-photo-338504.jpeg?auto=compress&cs=tinysrgb&w=1200',
                         location: 'Times Square, Manhattan'
                     },
                     {
                         nom: 'SoHo Art Hotel',
                         image: 'https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg?auto=compress&cs=tinysrgb&w=1200',
                         location: 'SoHo, Manhattan'
                     }
                 ]
             }"
             x-init="setInterval(() => { index = (index + 1) % hotels.length }, 4000)"
             class="relative h-screen flex items-center justify-center overflow-hidden">

        <!-- Background Images -->
        <div class="absolute inset-0">
            <template x-for="(hotel, i) in hotels" :key="i">
                <div class="absolute inset-0 transition-all duration-1000 transform"
                     :class="{ 
                         'opacity-0 scale-110': i !== index, 
                         'opacity-100 scale-100': i === index 
                     }">
                    <img :src="hotel.image" 
                         :alt="hotel.nom"
                         class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
                </div>
            </template>
        </div>

        <!-- Navigation Arrows -->
        <button @click="index = (index - 1 + hotels.length) % hotels.length"
                class="absolute left-8 z-20 p-3 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white hover:bg-white/30 transition-all duration-300 group">
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="index = (index + 1) % hotels.length"
                class="absolute right-8 z-20 p-3 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white hover:bg-white/30 transition-all duration-300 group">
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-6">
            <div class="bg-black/20 backdrop-blur-md rounded-3xl border border-white/20 p-12 shadow-2xl animate-fade-in">
                <h1 class="text-6xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white via-blue-100 to-indigo-200 bg-clip-text text-transparent animate-float">
                    Bienvenue
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 leading-relaxed">
                    Découvrez l'excellence hôtelière au cœur de New York City. 
                    Des expériences uniques vous attendent dans nos établissements d'exception.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#hotel-list" 
                       class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-full font-semibold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Découvrir nos hôtels
                    </a>
                    <button class="bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-full font-semibold border border-white/30 hover:bg-white/30 transform hover:scale-105 transition-all duration-300">
                        Réserver maintenant
                    </button>
                </div>
            </div>
        </div>

        <!-- Slide Indicators -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
            <template x-for="(hotel, i) in hotels" :key="i">
                <button @click="index = i"
                        class="w-3 h-3 rounded-full transition-all duration-300"
                        :class="{ 
                            'bg-white scale-125': i === index, 
                            'bg-white/50 hover:bg-white/70': i !== index 
                        }">
                </button>
            </template>
        </div>
    </section>

       
    </section>

    <!-- Hotels Section dynamique -->
    <section id="hotel-list" class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 bg-clip-text text-transparent">
                    Nos Hôtels d'Exception
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($hotels as $hotel)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500">
                        <div class="relative overflow-hidden h-64">
                            <img src="{{ $hotel->image ? asset('storage/' . $hotel->image) : asset('storage/hotels/default-hotel.jpg') }}"
                                 alt="{{ $hotel->nom }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $hotel->nom }}
                            </h3>
                            <p class="text-slate-600 mb-4 leading-relaxed">
                                {{ Str::limit($hotel->description, 100) }}
                            </p>
                            <span class="block text-sm text-gray-500">📍 {{ $hotel->location }}</span>
                            <a href="{{ route('hotels.detail', $hotel->id) }}"
                               class="mt-4 inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:scale-105 transition-all">
                                Voir plus
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
     <!-- Footer -->
    <footer class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-xl">NYC</span>
                        </div>
                        <span class="text-2xl font-bold">New York City Hotels</span>
                    </div>
                    <p class="text-blue-100 leading-relaxed max-w-md">
                        Votre porte d'entrée vers l'expérience hôtelière new-yorkaise d'exception. 
                        Découvrez la ville qui ne dort jamais depuis nos établissements de prestige.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4 text-blue-200">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="#hero" class="text-blue-100 hover:text-white transition-colors duration-300">Accueil</a></li>
                        <li><a href="#hotel-list" class="text-blue-100 hover:text-white transition-colors duration-300">Nos Hôtels</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Réservations</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4 text-blue-200">Contact</h4>
                    <ul class="space-y-2 text-blue-100">
                        <li>📧 contact@nychhotels.com</li>
                        <li>📞 +1 (212) 555-0123</li>
                        <li>📍 New York, NY</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-blue-800/30 mt-12 pt-8 text-center">
                <p class="text-blue-200">
                    © <span x-text="new Date().getFullYear()"></span> New York City Hotels. Tous droits réservés. 
                    <span class="ml-2 text-blue-300">Créé avec ❤️ pour les amoureux de NYC</span>
                </p>
            </div>
        </div>
    </footer>
    {{-- <footer class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 text-white py-8 text-center">
        <p class="text-blue-200">
            © {{ date('Y') }} New York City Hotels. Tous droits réservés.
        </p>
    </footer> --}}

</body>
</html>
