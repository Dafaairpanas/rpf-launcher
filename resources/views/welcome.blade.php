<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPF Launcher - Rajawali Perkasa Furniture</title>
    <meta name="description" content="Akses cepat ke seluruh aplikasi kerja Rajawali Perkasa Furniture">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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

        /* Skeleton Styles */
        .skeleton-block {
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite linear;
        }
        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-inter flex flex-col">
    <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50 backdrop-blur-lg bg-white/90">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-10">
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

    <main class="w-full mx-auto px-4 sm:px-6 lg:px-10 py-12 flex-1">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6">
            <h3 class="text-[18 px] md:text-2xl font-semibold text-gray-800">
                Aplikasi dari Rajawali Perkasa Furniture
            </h3>
            <form id="searchForm" action="{{ route('home') }}" method="GET" class="w-full md:w-auto flex flex-col sm:flex-row gap-3" onsubmit="return false;">
                @if(request('tag_id'))
                    <input type="hidden" name="tag_id" value="{{ request('tag_id') }}">
                @endif
                
                <!-- <select name="sort" onchange="window.location.href='{{ route('home', ['search' => request('search'), 'tag_id' => request('tag_id')]) }}&sort=' + this.value" class="w-full sm:w-auto px-4 py-3.5 bg-white border-2 border-gray-200 rounded-2xl text-sm font-medium text-gray-700 focus:outline-none focus:border-amber-400 transition-all duration-200 shadow-sm cursor-pointer hover:border-gray-300">
                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Urutan Default</option>
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A-Z</option>
                    <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z-A</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select> -->

                <div class="relative w-full md:w-96 lg:w-[28rem]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Cari aplikasi...  '/'"
                        class="search-input w-full pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:outline-none focus:border-amber-400 transition-all duration-200 shadow-sm hover:border-gray-300 text-base"
                    >
                </div>
            </form>
        </div>

        @if($tags->isNotEmpty())
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('home', ['search' => request('search')]) }}" 
               class="px-4 py-1.5 rounded-full text-sm font-medium transition-colors border {{ !request('tag_id') ? 'bg-amber-100 text-amber-800 border-amber-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                Semua
            </a>
            @foreach($tags as $tag)
                <a href="{{ route('home', ['search' => request('search'), 'tag_id' => $tag->id]) }}" 
                   class="px-4 py-1.5 rounded-full text-sm font-medium transition-colors border flex items-center gap-1.5 {{ request('tag_id') == $tag->id ? 'bg-amber-100 text-amber-800 border-amber-200 shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                   @if($tag->color)
                   <span class="inline-block w-2.5 h-2.5 rounded-full" style="background-color: {{ $tag->color }}"></span>
                   @endif
                   {{ $tag->name }}
                </a>
            @endforeach
        </div>
        @endif

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
            <!-- Skeleton Loading Container -->
            <div id="skeleton-container" class="grid gap-6" style="grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
                @for($i = 0; $i < 8; $i++)
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm h-full flex flex-col">
                    <div class="aspect-[4/3] skeleton-block"></div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="h-5 skeleton-block rounded-md w-3/4 mb-3"></div>
                            <div class="h-3 skeleton-block rounded-md w-1/2 mb-4"></div>
                        </div>
                        <div class="h-4 skeleton-block rounded-md w-full mt-4"></div>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Actual Apps Grid (Hidden until fully loaded) -->
            <div id="app-grid" class="grid gap-6 hidden" style="grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
                @foreach($applications as $app)
                    <a href="{{ $app->app_url }}" target="_blank" rel="noopener noreferrer" class="card-hover block app-card" data-name="{{ strtolower($app->name) }}">
                        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm h-full flex flex-col relative">
                            
                            <div class="absolute top-3 right-3 z-20 flex flex-col items-end gap-1.5">
                                @forelse($app->tags as $tag)
                                    @php
                                        $hex = ltrim($tag->color ?? '#f59e0b', '#');
                                        $r = hexdec(substr($hex, 0, 2));
                                        $g = hexdec(substr($hex, 2, 2));
                                        $b = hexdec(substr($hex, 4, 2));
                                        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                                        $isLight = $luminance > 0.6;
                                        $textColor = $isLight ? '#1f2937' : '#ffffff';
                                        $borderStyle = $isLight ? '1px solid rgba(0,0,0,0.15)' : '1px solid rgba(255,255,255,0.3)';
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold shadow-sm backdrop-blur-md" 
                                          style="background-color: {{ $tag->color ?? '#f59e0b' }}E6; color: {{ $textColor }}; border: {{ $borderStyle }};">
                                        {{ $tag->name }}
                                    </span>
                                @empty
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold shadow-sm bg-white/80 text-gray-700 backdrop-blur-md border border-white/50">
                                        All
                                    </span>
                                @endforelse
                            </div>

                            <div class="aspect-[4/3] flex items-center justify-center p-6 relative overflow-hidden border-b-2" style="background-color: {{ $app->theme_color }}; border-color: {{ $app->theme_color }}">
                                <div class="absolute inset-0 opacity-50">
                                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-white/30 rounded-full blur-xl"></div>
                                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-white/20 rounded-full blur-lg"></div>
                                </div>
                                @if($app->image_url)
                                    <img src="{{ $app->image_url }}" alt="{{ $app->name }}" loading="lazy" class="w-20 h-20 object-contain relative z-10 drop-shadow-lg">
                                @else
                                    <div class="w-20 h-20 bg-white/60 backdrop-blur rounded-2xl flex items-center justify-center relative z-10 shadow-lg">
                                        <span class="text-2xl font-bold text-gray-600">{{ substr($app->name, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-1 h-full">
                                <h4 class="font-bold text-gray-800 text-lg mb-1 truncate">{{ $app->name }}</h4>
                                <p class="text-gray-500 text-sm line-clamp-2">{{ $app->description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="bg-white border-t border-gray-100 mt-auto">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-10 py-8">
            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                <p class="text-gray-500 text-[12px]">
                    &copy; {{ date('Y') }} Rajawali Perkasa Furniture — All Rights Reserved
                </p>

            </div>
        </div>
    </footer>

    <script>
        const searchInput = document.getElementById('searchInput');
        const appGrid = document.getElementById('app-grid');

        // Hotkey for search
        document.addEventListener('keydown', function(e) {
            if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                e.preventDefault();
                if (searchInput) searchInput.focus();
            }
        });

        // Skeleton removal (Optimized for speed)
        document.addEventListener('DOMContentLoaded', function() {
            const skeleton = document.getElementById('skeleton-container');
            const appGrid = document.getElementById('app-grid');
            
            // Remove skeleton after a very short delay to allow layout calculation
            setTimeout(() => {
                if (skeleton && appGrid) {
                    skeleton.style.transition = 'opacity 0.3s ease-out';
                    skeleton.style.opacity = '0';
                    setTimeout(() => {
                        skeleton.remove();
                        appGrid.classList.remove('hidden');
                        appGrid.style.animation = 'fadeIn 0.4s ease-out forwards';
                    }, 300);
                }
            }, 100);
        });

        if (searchInput && appGrid) {
            searchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase().trim();
                const cards = appGrid.querySelectorAll('.app-card');
                let visibleCount = 0;

                cards.forEach(card => {
                    const name = card.dataset.name || '';
                    const match = name.includes(query);
                    card.style.display = match ? '' : 'none';
                    if (match) visibleCount++;
                });

                // Tampilkan pesan jika tidak ada hasil
                let emptyMsg = appGrid.parentElement.querySelector('#no-results-msg');
                if (visibleCount === 0 && query !== '') {
                    if (!emptyMsg) {
                        emptyMsg = document.createElement('div');
                        emptyMsg.id = 'no-results-msg';
                        emptyMsg.className = 'text-center py-12 col-span-4';
                        emptyMsg.innerHTML = `
                            <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 font-medium">Tidak ada aplikasi ditemukan</p>
                            <p class="text-gray-400 text-sm mt-1">Coba kata kunci lain</p>`;
                        appGrid.parentElement.appendChild(emptyMsg);
                    }
                } else if (emptyMsg) {
                    emptyMsg.remove();
                }
            });
        }
    </script>
</body>
</html>

