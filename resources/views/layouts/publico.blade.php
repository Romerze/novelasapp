<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'NovelasApp'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans text-gray-800 bg-gray-50">
        <div class="flex flex-col min-h-screen">
            <!-- Header -->
            <header class="bg-gradient-to-r from-purple-700 to-indigo-900 text-white shadow-lg">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row items-center justify-between px-4 py-3">
                        <!-- Logo -->
                        <a href="{{ route('inicio') }}" class="flex items-center space-x-2 mb-3 md:mb-0">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                                <path d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.5 2V9.85999C15.5 10.3 14.98 10.52 14.66 10.23L12.34 8.09003C12.15 7.91003 11.85 7.91003 11.66 8.09003L9.34003 10.23C9.02003 10.52 8.5 10.3 8.5 9.85999V2" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-2xl font-serif font-bold tracking-tight">
                                <span class="text-white">Novelas</span><span class="text-purple-200">App</span>
                            </span>
                        </a>
                        
                        <!-- Nav Links - Desktop -->
                        <nav class="hidden md:flex items-center space-x-6">
                            <a href="{{ route('inicio') }}" class="font-medium hover:text-purple-200 transition-colors {{ request()->routeIs('inicio') ? 'text-white border-b-2 border-purple-300' : 'text-purple-100' }}">
                                <i class="fas fa-home mr-1"></i> Inicio
                            </a>
                            <a href="{{ route('novelas.publico.index') }}" class="font-medium hover:text-purple-200 transition-colors {{ request()->routeIs('novelas.publico.*') ? 'text-white border-b-2 border-purple-300' : 'text-purple-100' }}">
                                <i class="fas fa-book mr-1"></i> Novelas
                            </a>
                            <a href="{{ route('generos.publico.index') }}" class="font-medium hover:text-purple-200 transition-colors {{ request()->routeIs('generos.publico.*') ? 'text-white border-b-2 border-purple-300' : 'text-purple-100' }}">
                                <i class="fas fa-tag mr-1"></i> Géneros
                            </a>
                            
                            <!-- Botón de búsqueda -->
                            <form action="{{ route('buscar') }}" method="GET" class="relative">
                                <input type="text" name="q" placeholder="Buscar..." class="rounded-full bg-purple-800/50 border-purple-600 text-white placeholder-purple-300 px-4 py-1.5 pr-8 focus:outline-none focus:ring-2 focus:ring-purple-300 text-sm w-36 md:w-44">
                                <button type="submit" class="absolute right-0 top-0 h-full px-2 flex items-center justify-center text-purple-300">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                            
                            @if (Auth::check())
                                <a href="{{ route('dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-1.5 rounded-full text-sm font-medium transition-colors flex items-center">
                                    <i class="fas fa-user-circle mr-1.5"></i> Mi Cuenta
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-1.5 rounded-full text-sm font-medium transition-colors">
                                    <i class="fas fa-sign-in-alt mr-1.5"></i> Acceder
                                </a>
                            @endif
                        </nav>
                        
                        <!-- Mobile menu button -->
                        <button type="button" data-collapse-toggle="navbar-mobile" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-300">
                            <span class="sr-only">Abrir menú principal</span>
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                    </div>
                    
                    <!-- Mobile menu -->
                    <div class="hidden md:hidden bg-purple-800 border-t border-purple-700" id="navbar-mobile">
                        <div class="px-3 py-4 space-y-1">
                            <a href="{{ route('inicio') }}" class="block px-3 py-2 rounded-md {{ request()->routeIs('inicio') ? 'bg-purple-900 text-white' : 'text-purple-100 hover:bg-purple-900/70' }}">
                                <i class="fas fa-home mr-2"></i> Inicio
                            </a>
                            <a href="{{ route('novelas.publico.index') }}" class="block px-3 py-2 rounded-md {{ request()->routeIs('novelas.publico.*') ? 'bg-purple-900 text-white' : 'text-purple-100 hover:bg-purple-900/70' }}">
                                <i class="fas fa-book mr-2"></i> Novelas
                            </a>
                            <a href="{{ route('generos.publico.index') }}" class="block px-3 py-2 rounded-md {{ request()->routeIs('generos.publico.*') ? 'bg-purple-900 text-white' : 'text-purple-100 hover:bg-purple-900/70' }}">
                                <i class="fas fa-tag mr-2"></i> Géneros
                            </a>
                            
                            <!-- Búsqueda móvil -->
                            <form action="{{ route('buscar') }}" method="GET" class="mt-3 px-3">
                                <div class="relative">
                                    <input type="text" name="q" placeholder="Buscar novelas..." class="w-full rounded-md bg-purple-900/60 border-purple-700 placeholder-purple-300 text-white py-2 px-4 text-sm">
                                    <button type="submit" class="absolute right-0 top-0 h-full px-3 flex items-center justify-center text-purple-300">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            
                            <div class="pt-2 mt-3 border-t border-purple-700">
                                @if (Auth::check())
                                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-purple-100 hover:bg-purple-900/70">
                                        <i class="fas fa-user-circle mr-2"></i> Mi Panel
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-purple-100 hover:bg-purple-900/70">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                                    </a>
                                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-purple-100 hover:bg-purple-900/70">
                                        <i class="fas fa-user-plus mr-2"></i> Registrarse
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-grow py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Alertas y notificaciones -->
                    <div id="notifications" class="mb-6">
                        @if (session('success'))
                            <div id="alert-success" class="p-3 mb-3 rounded-lg bg-green-50 border border-green-200 flex items-center shadow-sm">
                                <div class="flex-shrink-0 w-5 h-5 text-green-600">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-green-700">{{ session('success') }}</p>
                                </div>
                                <button type="button" onclick="document.getElementById('alert-success').remove()" class="ml-auto text-green-400 hover:text-green-600 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
                                    <span class="sr-only">Cerrar</span>
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div id="alert-error" class="p-3 mb-3 rounded-lg bg-red-50 border border-red-200 flex items-center shadow-sm">
                                <div class="flex-shrink-0 w-5 h-5 text-red-600">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
                                </div>
                                <button type="button" onclick="document.getElementById('alert-error').remove()" class="ml-auto text-red-400 hover:text-red-600 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
                                    <span class="sr-only">Cerrar</span>
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-8 mt-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center space-x-2 mb-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-purple-600">
                                    <path d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.5 2V9.85999C15.5 10.3 14.98 10.52 14.66 10.23L12.34 8.09003C12.15 7.91003 11.85 7.91003 11.66 8.09003L9.34003 10.23C9.02003 10.52 8.5 10.3 8.5 9.85999V2" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-xl font-serif font-bold tracking-tight">
                                    <span class="text-purple-700">Novelas</span><span class="text-gray-700">App</span>
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 pr-4">NovelasApp es una plataforma para escritores y lectores donde puedes publicar, leer y compartir tus historias con la comunidad.</p>
                            
                            <div class="flex space-x-4 mt-4">
                                <a href="#" class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center hover:bg-purple-200 transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center hover:bg-purple-200 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center hover:bg-purple-200 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Explorar</h3>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('novelas.publico.index') }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                        Todas las novelas
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('generos.publico.index') }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                        Géneros literarios
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('novelas.publico.index', ['orden' => 'populares']) }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                        Novelas populares
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('novelas.publico.index', ['orden' => 'recientes']) }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                        Últimas novelas
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Mi cuenta</h3>
                            <ul class="space-y-2">
                                @if(Auth::check())
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                            Panel de control
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('novelas.index') }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                            Mis novelas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                            Perfil
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                            Iniciar sesión
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-purple-600 transition-colors text-sm">
                                            Registrarse
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mt-8 flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} NovelasApp. Todos los derechos reservados.</p>
                        
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-gray-500 hover:text-purple-600 transition-colors text-sm">
                                Términos de servicio
                            </a>
                            <a href="#" class="text-gray-500 hover:text-purple-600 transition-colors text-sm">
                                Política de privacidad
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Flowbite JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        
        <!-- Alpine JS -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- Script para animar aparición/desaparición de notificaciones -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const alerts = document.querySelectorAll('#notifications > div');
                alerts.forEach(alert => {
                    // Auto cerrar alertas después de 6 segundos
                    setTimeout(() => {
                        if(alert) {
                            alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                            setTimeout(() => {
                                if(alert) alert.remove();
                            }, 500);
                        }
                    }, 6000);
                });
            });
        </script>
        
        @yield('scripts')
    </body>
</html>
