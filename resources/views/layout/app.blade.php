<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        #sidebar {
            width: 17rem;
        }

        #sidebar.collapsed {
            width: 5rem !important;
        }

        #sidebar.collapsed .sidebar-text {
            display: none !important;
        }

        #sidebar.collapsed .sidebar-icon {
            margin-right: 0 !important;
        }

        #sidebar.collapsed .menu-item {
            justify-content: center !important;
        }

        #main-content {
            margin-left: 16rem;
        }

        #main-content.sidebar-collapsed {
            margin-left: 5rem !important;
        }

        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 40;
                height: 100vh;
                transition: transform 0.3s ease-in-out;
            }

            #sidebar.mobile-open {
                transform: translateX(0);
            }

            #main-content {
                margin-left: 0 !important;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 30;
            }

            .overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="flex min-h-screen">
        <div id="mobile-overlay" class="overlay"></div>
        <aside id="sidebar"
            class="bg-primary text-white flex flex-col transition-all duration-300 ease-in-out fixed h-full top-0 left-0 z-30">
            <div class="relative">
                <button id="sidebar-toggle" title="Toggle Sidebar"
                    class="hidden absolute md:flex hover:cursor-pointer -right-3 top-5 z-100 bg-white rounded-full w-6 h-6  items-center justify-center shadow-sm hover:bg-gray-100 transition-all">
                    <i id="toggle-icon" class="fas fa-times text-xs text-gray-800"></i>
                </button>
            </div>
            <div class="p-4 text-xl font-bold border-b border-white/20 flex items-center">
                <a href="/dashboard" class="inline-flex items-center">
                    <img src="{{ asset('images/logo.png') }}" class="h-5">
                    <span class="ml-2 text-sm sidebar-text">Aplikasi Pengelolaan Barang</span>
                </a>
            </div>
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('incoming-goods.index') }}"
                            class="{{ request()->is('incoming-goods') ? 'side-menu-active' : 'side-menu' }}">
                            <i class="fa-solid fa-download sidebar-icon mr-3"></i>
                            <span class="sidebar-text">Barang Masuk</span>
                        </a>
                    </li>
                    <li>
                    <li>
                        <div x-data="{ open: {{ request()->is('categories') || request()->is('subcategories*') ? 'true' : 'false' }} }" class="relative">
                            <button @click="open = !open" class="side-menu w-full justify-between hover:cursor-pointer">
                                <div class="flex items-center">
                                    <i class="fa-regular fa-bookmark sidebar-icon mr-3"></i>
                                    <span class="sidebar-text">Master Data</span>
                                </div>
                                <i class="fas fa-chevron-down sidebar-icon text-xs transition-transform duration-200 sidebar-text"
                                    :class="{ 'transform rotate-180': open }"></i>
                            </button>

                            <div x-show="open" x-collapse class="ml-8 mt-1 pl-3 border-l-2 border-white/20">
                                <ul class="space-y-1">
                                    <li class="relative">
                                        <div class="absolute -left-3 top-3 h-[1px] w-3 bg-white/20"></div>
                                        <a href="{{ route('categories.index') }}"
                                            class="{{ request()->is('categories') ? 'side-menu-active' : 'side-menu' }}">
                                            <i class="fas fa-tag mr-2 sidebar-icon text-xs"></i>
                                            <span class="sidebar-text">Kategori</span>
                                        </a>
                                    </li>
                                    <li class="relative">
                                        <div class="absolute -left-3 top-3 h-[1px] w-3 bg-white/20"></div>
                                        <a href="{{ route('subcategories.index') }}"
                                            class="{{ request()->is('subcategories') ? 'side-menu-active' : 'side-menu' }}">
                                            <i class="fas fa-tags mr-2 sidebar-icon text-xs"></i>
                                            <span class="sidebar-text">Sub Kategori</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @if (auth()->user()->hasRole('admin'))
                        <li>
                            <a href="#" class="side-menu">
                                <i class="fas fa-users-cog mr-3 sidebar-icon"></i>
                                <span class="sidebar-text">Manajemen User</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </aside>

        <div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ease-in-out">
            <header class="bg-white px-6 py-4 shadow flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button id="mobile-sidebar-toggle" class="md:hidden text-gray-600 hover:cursor-pointer">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-lg font-semibold">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <span class="text-sm text-gray-800 font-medium">
                            @auth {{ auth()->user()->name }} @endauth
                        </span><br>
                        <span class="text-xs text-gray-500">
                            @auth {{ auth()->user()->email }} @endauth
                        </span>
                    </div>

                    <div class="relative">
                        <button id="dropdown-toggle"
                            class="bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center font-semibold focus:outline-none">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                        </button>
                        <div id="dropdown-menu" class="absolute right-0 mt-2 bg-white rounded shadow z-10 w-32 hidden">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4 md:p-6 bg-gray-200 flex-1 overflow-x-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const mobileToggleBtn = document.getElementById('mobile-sidebar-toggle');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const toggleIcon = document.getElementById('toggle-icon');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            const isMobile = window.matchMedia('(max-width: 768px)').matches;

            function setSidebarState(collapsed) {
                if (isMobile) {
                    return;
                }

                if (collapsed) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('sidebar-collapsed');
                    toggleIcon.classList.remove('fa-times');
                    toggleIcon.classList.add('fa-bars');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('sidebar-collapsed');
                    toggleIcon.classList.remove('fa-bars');
                    toggleIcon.classList.add('fa-times');
                }
                localStorage.setItem('sidebarCollapsed', collapsed);
            }

            function toggleMobileSidebar() {
                sidebar.classList.toggle('mobile-open');
                mobileOverlay.classList.toggle('active');
                toggleIcon.classList.remove('fa-times');
                document.body.classList.toggle('overflow-hidden');
            }
            if (!isMobile) {
                setSidebarState(isCollapsed);
            }
            toggleBtn.addEventListener('click', function() {
                if (isMobile) {
                    toggleMobileSidebar();
                } else {
                    const currentlyCollapsed = sidebar.classList.contains('collapsed');
                    setSidebarState(!currentlyCollapsed);
                }
            });
            mobileToggleBtn.addEventListener('click', function() {
                toggleMobileSidebar();
            });
            mobileOverlay.addEventListener('click', function() {
                toggleMobileSidebar();
            });
            const dropdownToggle = document.getElementById('dropdown-toggle');
            const dropdownMenu = document.getElementById('dropdown-menu');

            document.addEventListener('click', function(e) {
                if (dropdownToggle.contains(e.target)) {
                    dropdownMenu.classList.toggle('hidden');
                } else if (!dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
            const sidebarLinks = document.querySelectorAll('#sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (isMobile) {
                        toggleMobileSidebar();
                    }
                });
            });
            window.addEventListener('resize', function() {
                const isNowMobile = window.matchMedia('(max-width: 768px)').matches;

                if (isNowMobile !== isMobile) {
                    if (isNowMobile) {
                        sidebar.classList.remove('collapsed');
                        sidebar.classList.remove('mobile-open');
                        mobileOverlay.classList.remove('active');
                    } else {
                        const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                        setSidebarState(collapsed);
                    }
                }
            });
        });
    </script>
</body>

</html>
