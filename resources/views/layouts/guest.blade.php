<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NovelasApp') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .animate-fade-in {
                animation: fadeIn 0.8s ease-in-out;
            }
            
            .animate-slide-up {
                animation: slideUp 0.6s ease-out;
            }
            
            .animate-pulse-slow {
                animation: pulseSlow 3s infinite;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            @keyframes slideUp {
                from { transform: translateY(30px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            
            @keyframes pulseSlow {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            .bg-book-pattern {
                background-color: #f8f9fa;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-book-pattern">
            <div class="mb-6 animate-fade-in">
                <a href="/" class="flex flex-col items-center text-center">
                    <h1 class="text-4xl font-bold text-indigo-700 font-serif mb-2" style="font-family: 'Playfair Display', serif;">NovelasApp</h1>
                    <p class="text-gray-600 italic">Tu plataforma de novelas en línea</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-3 px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg border border-indigo-100 animate-slide-up">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500 animate-fade-in">
                <p>  {{ date('Y') }} NovelasApp - Todos los derechos reservados</p>
            </div>
        </div>
    </body>
</html>
