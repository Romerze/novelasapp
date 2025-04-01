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
    <body class="antialiased bg-gray-100 font-sans text-gray-800">
        <div class="flex flex-col min-h-screen">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="flex-grow pt-16 pb-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Alertas y notificaciones -->
                    <div id="notifications" class="mb-4">
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

                        @if (session('info'))
                            <div id="alert-info" class="p-3 mb-3 rounded-lg bg-blue-50 border border-blue-200 flex items-center shadow-sm">
                                <div class="flex-shrink-0 w-5 h-5 text-blue-600">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-blue-700">{{ session('info') }}</p>
                                </div>
                                <button type="button" onclick="document.getElementById('alert-info').remove()" class="ml-auto text-blue-400 hover:text-blue-600 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
                                    <span class="sr-only">Cerrar</span>
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if (session('warning'))
                            <div id="alert-warning" class="p-3 mb-3 rounded-lg bg-yellow-50 border border-yellow-200 flex items-center shadow-sm">
                                <div class="flex-shrink-0 w-5 h-5 text-yellow-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-yellow-700">{{ session('warning') }}</p>
                                </div>
                                <button type="button" onclick="document.getElementById('alert-warning').remove()" class="ml-auto text-yellow-400 hover:text-yellow-600 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
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
            <footer class="bg-white shadow py-4 border-t border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="flex items-center mb-3 md:mb-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary-500 mr-2">
                                <path d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.5 2V9.85999C15.5 10.3 14.98 10.52 14.66 10.23L12.34 8.09003C12.15 7.91003 11.85 7.91003 11.66 8.09003L9.34003 10.23C9.02003 10.52 8.5 10.3 8.5 9.85999V2" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-xs text-gray-600">&copy; {{ date('Y') }} NovelasApp. Todos los derechos reservados.</span>
                        </div>
                        <div class="flex space-x-5">
                            <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors text-sm">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors text-sm">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors text-sm">
                                <i class="fab fa-instagram"></i>
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
        
        @yield('scripts')

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
    </body>
</html>
