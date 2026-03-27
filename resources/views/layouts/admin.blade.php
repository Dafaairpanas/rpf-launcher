<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - RPF Launcher</title>
    <meta name="description" content="Admin Panel RPF Launcher">
    <meta name="theme-color" content="#78350f">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'inter': ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <script>
        // Prevent flicker by checking localstorage immediately
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background: rgba(245, 158, 11, 0.1);
        }

        .sidebar-link.active {
            background: rgba(245, 158, 11, 0.15);
            border-right: 3px solid #f59e0b;
        }

        /* TomSelect Tailwind Customization */
        .ts-wrapper .ts-control {
            border: 1px solid #e5e7eb !important;
            border-radius: 0.75rem !important;
            padding: 0.75rem 1rem !important;
            font-size: 1rem !important;
            min-height: auto !important;
            background-color: #fff !important;
            box-shadow: none !important;
            transition: all 0.2s !important;
            outline: none !important;
        }

        .ts-wrapper.focus .ts-control {
            border-color: transparent !important;
            box-shadow: 0 0 0 2px #fbbf24 !important; /* amber-400 */
        }
        
        .ts-dropdown {
            border-radius: 0.75rem !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            padding: 0.5rem 0 !important;
            margin-top: 0.25rem !important;
        }
        
        .ts-dropdown .option {
            padding: 0.5rem 1rem !important;
        }
        
        .ts-dropdown .active {
            background-color: #fffbeb !important;
            color: #d97706 !important;
        }

        /* Collapsible Sidebar Styles */
        @media (min-width: 1024px) {
            #sidebar {
                transition: width 0.3s ease;
            }
            #main-content {
                transition: margin-left 0.3s ease;
            }
            html.sidebar-collapsed #sidebar {
                width: 5rem; /* w-20 */
            }
            html.sidebar-collapsed #main-content {
                margin-left: 5rem;
            }
            html.sidebar-collapsed .sidebar-text {
                display: none;
            }
            html.sidebar-collapsed .sidebar-header {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
                justify-content: center;
            }
            html.sidebar-collapsed .sidebar-link {
                padding-left: 0;
                padding-right: 0;
                justify-content: center;
            }
            html.sidebar-collapsed .sidebar-user-section {
                padding: 1rem 0;
                align-items: center;
            }
            html.sidebar-collapsed .sidebar-user-section > div {
                justify-content: center;
                padding: 0;
            }
            html.sidebar-collapsed .sidebar-user-avatar {
                margin: 0;
            }
            html.sidebar-collapsed .sidebar-logout-btn {
                padding-left: 0;
                padding-right: 0;
                justify-content: center;
            }
            html.sidebar-collapsed #toggle-icon {
                transform: rotate(180deg);
            }
        }
    </style>
    </style>
</head>

<body class="bg-gray-50 font-inter">
    <div class="flex min-h-screen">
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
            <div class="sidebar-header flex items-center gap-3 px-6 py-5 border-b border-gray-100 h-[73px] relative group shrink-0">
                <img src="/icons/logo.png" alt="RPF Logo" class="sidebar-logo w-10 h-10 rounded-xl object-contain">
                <div class="sidebar-text truncate">
                    <h1 class="font-bold text-gray-800">RPF Launcher</h1>
                    <p class="text-xs text-gray-500">Admin Panel</p>
                </div>
                <!-- Toggle Button (Desktop Only) -->
                <button onclick="toggleDesktopSidebar()" class="hidden lg:flex absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-white border border-gray-200 rounded-full items-center justify-center text-gray-400 hover:text-amber-600 hover:border-amber-400 opacity-0 group-hover:opacity-100 transition-all z-10 shadow-sm cursor-pointer" title="Toggle Sidebar">
                    <svg id="toggle-icon" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
            <nav class="p-4 space-y-1 flex-1 overflow-y-auto">
                <a href="{{ route('admin.applications.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="sidebar-text font-medium truncate">Applications</span>
                </a>
                <a href="{{ route('admin.tags.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span class="sidebar-text font-medium truncate">Tags</span>
                </a>
                @if(Auth::user()->role?->name === 'Super Admin')
                <a href="{{ route('admin.roles.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="sidebar-text font-medium truncate">Roles</span>
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="sidebar-text font-medium truncate">Users</span>
                </a>
                @endif
                <a href="{{ route('home') }}" target="_blank"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span class="sidebar-text font-medium truncate">View Site</span>
                </a>
            </nav>
            <div class="sidebar-user-section shrink-0 border-t border-gray-100 p-4 w-full bg-white">
                <div class="flex items-center gap-3 mb-3 px-2">
                    <div class="sidebar-user-avatar w-9 h-9 bg-gray-200 rounded-full flex shrink-0 items-center justify-center">
                        <span class="text-sm font-semibold text-gray-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="sidebar-text flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="sidebar-logout-btn w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-colors shrink-0">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="sidebar-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden transition-opacity" id="sidebar-overlay" onclick="toggleSidebar()">
        </div>

        <div id="main-content" class="flex-1 flex flex-col min-w-0 lg:ml-64 relative">
            <header
                class="bg-white border-b border-gray-200 px-4 lg:px-8 py-4 flex items-center justify-between sticky top-0 z-30">
                <button onclick="toggleSidebar()"
                    class="lg:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h2 class="text-lg font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                <div class="flex items-center gap-3">
                    @yield('header-actions')
                </div>
            </header>

            <main class="flex-1 p-4 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleDesktopSidebar() {
            const html = document.documentElement;
            html.classList.toggle('sidebar-collapsed');
            
            if (html.classList.contains('sidebar-collapsed')) {
                localStorage.setItem('sidebar-collapsed', 'true');
            } else {
                localStorage.setItem('sidebar-collapsed', 'false');
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js');
        }

        document.addEventListener('DOMContentLoaded', () => {
            // SweetAlert2 Toast configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
            @endif
            @if(session('error'))
                Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
            @endif
            @if($errors->any())
                Toast.fire({ icon: 'error', title: "{{ $errors->first() }}" });
            @endif

            // Global Delete Confirmation Interceptor
            document.querySelectorAll('form').forEach(form => {
                if (form.hasAttribute('onsubmit') && form.getAttribute('onsubmit').includes('confirm')) {
                    form.removeAttribute('onsubmit');
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Konfirmasi Hapus',
                            text: 'Apakah Anda yakin ingin menghapus data ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                            customClass: {
                                confirmButton: 'px-5 py-2.5 rounded-xl text-sm font-medium',
                                cancelButton: 'px-5 py-2.5 rounded-xl text-sm font-medium',
                                popup: 'rounded-2xl shadow-xl border border-gray-100'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
