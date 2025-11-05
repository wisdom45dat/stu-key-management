<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STU Key Management - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar:hover {
            width: 16rem;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-lg w-20 md:w-64 fixed inset-y-0 left-0 z-50">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="bg-primary rounded-lg p-2">
                        <i class="fas fa-key text-white text-xl"></i>
                    </div>
                    <span class="hidden md:block text-xl font-bold text-gray-800">STU Keys</span>
                </div>
            </div>
            
            <nav class="mt-6 px-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-primary rounded-lg transition-colors group {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-primary border-r-2 border-primary' : '' }}">
                    <i class="fas fa-chart-pie text-lg w-6"></i>
                    <span class="hidden md:block ml-3 font-medium">Dashboard</span>
                </a>

                @can('access kiosk')
                <!-- Kiosk -->
                <a href="{{ route('kiosk.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-primary rounded-lg transition-colors group {{ request()->routeIs('kiosk.*') ? 'bg-blue-50 text-primary border-r-2 border-primary' : '' }}">
                    <i class="fas fa-qrcode text-lg w-6"></i>
                    <span class="hidden md:block ml-3 font-medium">Kiosk</span>
                </a>
                @endcan

                @canany(['admin', 'security', 'hr'])
                <!-- Keys -->
                <a href="{{ route('keys.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-primary rounded-lg transition-colors group {{ request()->routeIs('keys.*') ? 'bg-blue-50 text-primary border-r-2 border-primary' : '' }}">
                    <i class="fas fa-key text-lg w-6"></i>
                    <span class="hidden md:block ml-3 font-medium">Key Management</span>
                </a>
                @endcanany

                @can('admin')
                <!-- Locations -->
                <a href="{{ route('locations.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-primary rounded-lg transition-colors group {{ request()->routeIs('locations.*') ? 'bg-blue-50 text-primary border-r-2 border-primary' : '' }}">
                    <i class="fas fa-map-marker-alt text-lg w-6"></i>
                    <span class="hidden md:block ml-3 font-medium">Locations</span>
                </a>
                @endcan

                @canany(['admin', 'hr'])
                <!-- HR -->
                <a href="{{ route('hr.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-primary rounded-lg transition-colors group {{ request()->routeIs('hr.*') ? 'bg-blue-50 text-primary border-r-2 border-primary' : '' }}">
                    <i class="fas fa-users text-lg w-6"></i>
                    <span class="hidden md:block ml-3 font-medium">HR Management</span>
                </a>
                @endcanany

                @canany(['admin', 'hr', 'auditor'])
                <!-- Reports -->
                <a href="{{ route('reports.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-primary rounded-lg transition-colors group {{ request()->routeIs('reports.*') ? 'bg-blue-50 text-primary border-r-2 border-primary' : '' }}">
                    <i class="fas fa-chart-bar text-lg w-6"></i>
                    <span class="hidden md:block ml-3 font-medium">Reports</span>
                </a>
                @endcanany

                @can('admin')
                <!-- Admin -->
                <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-primary rounded-lg transition-colors group {{ request()->routeIs('admin.*') ? 'bg-blue-50 text-primary border-r-2 border-primary' : '' }}">
                    <i class="fas fa-cog text-lg w-6"></i>
                    <span class="hidden md:block ml-3 font-medium">Admin</span>
                </a>
                @endcan
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-20 lg:ml-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="md:hidden text-gray-600">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-600 hover:text-primary rounded-full hover:bg-gray-100">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-0 right-0 bg-danger text-white rounded-full w-2 h-2"></span>
                        </button>

                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <div class="hidden md:block text-left">
                                    <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-600 capitalize">{{ auth()->user()->getRoleNames()->first() }}</p>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                                <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-user mr-3"></i>
                                    Profile
                                </a>
                                <a href="{{ route('profile.activity') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-history mr-3"></i>
                                    Activity Log
                                </a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-success text-white p-4 rounded-lg mb-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-danger text-white p-4 rounded-lg mb-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @stack('scripts')
</body>
</html>
