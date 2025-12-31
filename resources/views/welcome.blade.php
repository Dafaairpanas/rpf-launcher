<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPF Launcher - Rajawali Perkasa Furniture</title>
    <meta name="description" content="Akses cepat ke seluruh aplikasi kerja Rajawali Perkasa Furniture">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'hero': '#FDE6B6',
                        'hero-dark': '#F5D89A',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(253, 230, 182, 0.5);
        }
        .gradient-text {
            background: linear-gradient(135deg, #1a1a1a 0%, #4a4a4a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #FDE6B6 0%, #F5D89A 50%, #FCECC4 100%);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-inter flex flex-col">
    <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50 backdrop-blur-lg bg-white/90">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-16 gap-3">
                <div class="flex-shrink-0">
                    <img src="/icons/logo.png" alt="RPF Logo" class="w-10 h-10 rounded-xl object-contain">
                </div>
                <h1 class="text-xl font-bold text-gray-800 tracking-tight">
                    RPF Launcher
                </h1>
            </div>
        </div>
    </header>

    <section class="hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/40 rounded-full blur-3xl float-animation"></div>
            <div class="absolute bottom-10 right-20 w-48 h-48 bg-orange-200/40 rounded-full blur-3xl float-animation" style="animation-delay: -2s;"></div>
            <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-yellow-200/30 rounded-full blur-2xl float-animation" style="animation-delay: -4s;"></div>
        </div>

    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1 w-full">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <h3 class="text-xl md:text-2xl font-semibold text-gray-800">
                Aplikasi dari Rajawali Perkasa Furniture
            </h3>
            <form action="{{ route('home') }}" method="GET" class="w-full md:w-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search ?? '' }}"
                        placeholder="Cari aplikasi..."
                        class="search-input w-full md:w-80 pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:outline-none focus:border-amber-400 transition-all duration-200"
                    >
                </div>
            </form>
        </div>

        @if($applications->isEmpty())
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada aplikasi ditemukan</h4>
                <p class="text-gray-500">Coba kata kunci pencarian lain</p>
                @if($search)
                    <a href="{{ route('home') }}" class="inline-flex items-center mt-4 text-amber-600 hover:text-amber-700 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Lihat semua aplikasi
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($applications as $app)
                    <a href="{{ $app->app_url }}" target="_blank" rel="noopener noreferrer" class="card-hover block">
                        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm h-full">
                            <div class="aspect-[4/3] flex items-center justify-center p-6 relative overflow-hidden border-b-2" style="background-color: {{ $app->theme_color }}; border-color: {{ $app->theme_color }}">
                                <div class="absolute inset-0 opacity-50">
                                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-white/30 rounded-full blur-xl"></div>
                                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-white/20 rounded-full blur-lg"></div>
                                </div>
                                @if($app->image_url)
                                    <img src="{{ $app->image_url }}" alt="{{ $app->name }}" class="w-20 h-20 object-contain relative z-10 drop-shadow-lg">
                                @else
                                    <div class="w-20 h-20 bg-white/60 backdrop-blur rounded-2xl flex items-center justify-center relative z-10 shadow-lg">
                                        <span class="text-2xl font-bold text-gray-600">{{ substr($app->name, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-gray-800 text-lg mb-1 truncate">{{ $app->name }}</h4>
                                <p class="text-gray-500 text-sm line-clamp-2">{{ $app->description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="bg-white border-t border-gray-100 mt-aut">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Rajawali Perkasa Furniture. All rights reserved.
                </p>
                <div class="flex items-center gap-2 text-gray-400">
                    <span class="text-sm">Powered by</span>
                    <span class="font-semibold text-gray-600">RPF Launcher</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
