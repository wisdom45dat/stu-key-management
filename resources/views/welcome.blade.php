<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Additional Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Fallback styles would go here -->
        @endif

        <style>
            :root {
                --primary: #6366f1;
                --primary-dark: #4f46e5;
                --primary-light: #c7d2fe;
                --secondary: #f8fafc;
                --accent: #f59e0b;
                --text-primary: #1e293b;
                --text-secondary: #64748b;
                --border: #e2e8f0;
                --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .dark {
                --primary: #818cf8;
                --primary-dark: #6366f1;
                --secondary: #1e293b;
                --text-primary: #f1f5f9;
                --text-secondary: #94a3b8;
                --border: #334155;
                --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3), 0 1px 2px 0 rgba(0, 0, 0, 0.2);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', 'Instrument Sans', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                color: var(--text-primary);
                transition: all 0.3s ease;
            }

            .dark body {
                background: linear-gradient(135deg, #1e3a8a 0%, #581c87 100%);
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 24px;
            }

            .dark .glass-card {
                background: rgba(30, 41, 59, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 12px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: var(--shadow);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
            }

            .btn-secondary {
                background: rgba(255, 255, 255, 0.1);
                color: var(--text-primary);
                border: 2px solid rgba(255, 255, 255, 0.2);
                padding: 10px 20px;
                border-radius: 10px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.2);
                border-color: rgba(255, 255, 255, 0.3);
            }

            /* Animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out;
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC]">
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-32 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative min-h-screen flex flex-col items-center justify-center p-6 lg:p-8">
            <!-- Header Navigation -->
            <header class="w-full max-w-6xl mb-8 lg:mb-12 animate-fade-in-up">
                <nav class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                            L
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    </div>

                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-secondary">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-secondary">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </nav>
            </header>

            <!-- Main Content -->
            <main class="w-full max-w-6xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-6 lg:space-y-8 animate-fade-in-up">
                        <div>
                            <h1 class="text-4xl lg:text-6xl font-bold leading-tight">
                                Build Something
                                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    Amazing
                                </span>
                            </h1>
                            <p class="text-xl lg:text-2xl text-gray-600 dark:text-gray-400 mt-4 leading-relaxed">
                                The PHP framework for web artisans. Create extraordinary applications with elegant syntax.
                            </p>
                        </div>

                        <!-- Quick Start Guide -->
                        <div class="glass-card p-6 lg:p-8 space-y-6">
                            <h2 class="text-2xl font-bold">Start Building Today</h2>
                            
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4 p-4 rounded-xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                        <span class="text-blue-600 dark:text-blue-400 font-semibold">1</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Explore Documentation</h3>
                                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                                            Dive into comprehensive guides and API documentation
                                        </p>
                                        <a href="https://laravel.com/docs" target="_blank" class="inline-flex items-center space-x-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 mt-2 font-medium">
                                            <span>View Documentation</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4 p-4 rounded-xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                        <span class="text-green-600 dark:text-green-400 font-semibold">2</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Master with Laracasts</h3>
                                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                                            Watch video tutorials and level up your skills
                                        </p>
                                        <a href="https://laracasts.com" target="_blank" class="inline-flex items-center space-x-2 text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 mt-2 font-medium">
                                            <span>Start Learning</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Call to Action -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <a href="https://cloud.laravel.com" target="_blank" class="btn-primary w-full text-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                    </svg>
                                    Deploy Your Application
                                </a>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="glass-card p-4">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">10M+</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Downloads</div>
                            </div>
                            <div class="glass-card p-4">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">150K+</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Stars</div>
                            </div>
                            <div class="glass-card p-4">
                                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">5K+</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Packages</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Hero Visual -->
                    <div class="relative animate-fade-in-up" style="animation-delay: 0.2s;">
                        <div class="glass-card p-8 rounded-3xl">
                            <!-- Animated Code Preview -->
                            <div class="bg-gray-900 rounded-2xl p-6 font-mono text-sm">
                                <div class="flex space-x-2 mb-4">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                </div>
                                <div class="space-y-2 text-gray-300">
                                    <div><span class="text-purple-400">Route</span>::<span class="text-blue-400">get</span>(<span class="text-green-400">'/'</span>, <span class="text-yellow-400">function</span> () {</div>
                                    <div class="ml-4"><span class="text-purple-400">return</span> <span class="text-blue-400">view</span>(<span class="text-green-400">'welcome'</span>);</div>
                                    <div>});</div>
                                    <div class="mt-4"><span class="text-purple-400">php</span> <span class="text-gray-500">artisan serve</span></div>
                                    <div><span class="text-green-400">Server running on</span> http://localhost:8000</div>
                                </div>
                            </div>

                            <!-- Floating Elements -->
                            <div class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl rotate-12 shadow-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            
                            <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl -rotate-12 shadow-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="w-full max-w-6xl mt-12 lg:mt-16 pt-8 border-t border-gray-200 dark:border-gray-700 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                    <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                        <span>Built with ❤️ by the Laravel community</span>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="https://github.com/laravel/laravel" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                            GitHub
                        </a>
                        <a href="https://twitter.com/laravelphp" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                            Twitter
                        </a>
                        <a href="https://laravel-news.com" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                            News
                        </a>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Theme Toggle -->
        <button id="theme-toggle" class="fixed top-6 right-6 p-3 rounded-xl bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-lg hover:shadow-xl transition-all duration-200 z-50">
            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>

        <script>
            // Theme Toggle
            const themeToggle = document.getElementById('theme-toggle');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const storedTheme = localStorage.getItem('theme');

            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }

            themeToggle.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            });

            // Add scroll animations
            document.addEventListener('DOMContentLoaded', function() {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, observerOptions);

                // Observe all animated elements
                document.querySelectorAll('.animate-fade-in-up').forEach(el => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(30px)';
                    el.style.transition = 'all 0.6s ease-out';
                    observer.observe(el);
                });
            });
        </script>
    </body>
</html>