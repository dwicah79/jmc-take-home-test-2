<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .collapsed {
            width: 70px !important;
            overflow: hidden;
        }

        .collapsed .nav-text,
        .collapsed .logo-text {
            display: none;
        }

        .collapsed .menu-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar-collapsed {
            margin-left: 70px !important;
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('sidebar-collapsed');
            }

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('dropdown-toggle');
            const menu = document.getElementById('dropdown-menu');

            document.addEventListener('click', function(e) {
                if (toggle.contains(e.target)) {
                    menu.classList.toggle('hidden');
                } else if (!menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="flex min-h-screen">
        <aside id="sidebar"
            class="w-1/4 bg-primary text-white flex flex-col transition-all duration-300 ease-in-out fixed h-full top-0 left-0 z-20">
            <div class="p-4 text-xl font-bold border-b border-white/20 flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.jpeg') }}" class="h-6 inline">
                    <span class="ml-2 text-lg logo-text">Aplikasi Pengelolaan Barang</span>
                </div>
                <button id="sidebar-toggle"
                    class="text-white text-xl hover:text-cyan-300 hover:cursor-pointer focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="block px-4 py-2 rounded menu-item active flex items-center">
                            <i class="fas fa-inbox mr-3"></i>
                            <span class="nav-text">Barang Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 rounded menu-item flex items-center">
                            <i class="fas fa-database mr-3"></i>
                            <span class="nav-text">Master Data</span>
                        </a>
                    </li>
                    @if (auth()->user()->hasRole('admin'))
                        <li>
                            <a href="#" class="block px-4 py-2 rounded menu-item flex items-center">
                                <i class="fas fa-users-cog mr-3"></i>
                                <span class="nav-text">Manajemen User</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </aside>
        <div id="main-content" class="flex-1 flex flex-col ml-64 transition-all duration-300 ease-in-out">
            <header class="bg-white px-6 py-4 shadow flex justify-between items-center">
                <div class="text-sm text-gray-600">
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
                        <div id="dropdown-menu" class="absolute right-0 mt-2 bg-white  rounded shadow z-10 w-32 hidden">
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

            <main class="p-6 bg-gray-200 flex-1">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
