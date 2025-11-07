<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'STU Key Management')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ url('/dashboard') }}" class="text-xl font-bold text-gray-800">
                                <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                                STU Key Management
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                            
                            <!-- Role-specific navigation -->
                            @auth
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="{{ url('/admin/dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-purple-600 hover:text-purple-700 hover:border-purple-300 focus:outline-none focus:text-purple-700 focus:border-purple-300 transition duration-150 ease-in-out">
                                        <i class="fas fa-crown mr-1"></i>Admin
                                    </a>
                                @endif
                                
                                @if(auth()->user()->hasRole('hr'))
                                    <a href="{{ url('/hr/dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-pink-600 hover:text-pink-700 hover:border-pink-300 focus:outline-none focus:text-pink-700 focus:border-pink-300 transition duration-150 ease-in-out">
                                        <i class="fas fa-user-tie mr-1"></i>HR
                                    </a>
                                @endif
                                
                                @if(auth()->user()->hasRole('security'))
                                    <a href="{{ url('/security/dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-blue-600 hover:text-blue-700 hover:border-blue-300 focus:outline-none focus:text-blue-700 focus:border-blue-300 transition duration-150 ease-in-out">
                                        <i class="fas fa-shield-alt mr-1"></i>Security
                                    </a>
                                @endif
                                
                                <a href="{{ url('/kiosk') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    Kiosk
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <div class="flex items-center space-x-4">
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">
                                        @auth
                                            @if(auth()->user()->hasRole('admin'))
                                                <span class="text-purple-600"><i class="fas fa-crown mr-1"></i>Administrator</span>
                                            @elseif(auth()->user()->hasRole('hr'))
                                                <span class="text-pink-600"><i class="fas fa-user-tie mr-1"></i>HR Manager</span>
                                            @elseif(auth()->user()->hasRole('security'))
                                                <span class="text-blue-600"><i class="fas fa-shield-alt mr-1"></i>Security Officer</span>
                                            @else
                                                <span class="text-gray-600">User</span>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                
                                <!-- Logout Form -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-700 hover:text-gray-900 focus:outline-none focus:underline transition duration-150 ease-in-out">
                                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ url('/dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                        Dashboard
                    </a>
                    
                    <!-- Role-specific mobile navigation -->
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ url('/admin/dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-purple-500 text-base font-medium text-purple-700 bg-purple-50 focus:outline-none focus:text-purple-800 focus:bg-purple-100 focus:border-purple-700 transition duration-150 ease-in-out">
                                <i class="fas fa-crown mr-2"></i>Admin Panel
                            </a>
                        @endif
                        
                        @if(auth()->user()->hasRole('hr'))
                            <a href="{{ url('/hr/dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-pink-500 text-base font-medium text-pink-700 bg-pink-50 focus:outline-none focus:text-pink-800 focus:bg-pink-100 focus:border-pink-700 transition duration-150 ease-in-out">
                                <i class="fas fa-user-tie mr-2"></i>HR Panel
                            </a>
                        @endif
                        
                        @if(auth()->user()->hasRole('security'))
                            <a href="{{ url('/security/dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out">
                                <i class="fas fa-shield-alt mr-2"></i>Security Panel
                            </a>
                        @endif
                        
                        <a href="{{ url('/kiosk') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            Kiosk
                        </a>
                    @endauth
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">
                            @auth
                                @if(auth()->user()->hasRole('admin'))
                                    <span class="text-purple-600"><i class="fas fa-crown mr-1"></i>Administrator</span>
                                @elseif(auth()->user()->hasRole('hr'))
                                    <span class="text-pink-600"><i class="fas fa-user-tie mr-1"></i>HR Manager</span>
                                @elseif(auth()->user()->hasRole('security'))
                                    <span class="text-blue-600"><i class="fas fa-shield-alt mr-1"></i>Security Officer</span>
                                @else
                                    <span class="text-gray-600">User</span>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
