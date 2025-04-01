@extends('layouts.app')

@section('title', 'Inicio - NovelasApp')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section con degradado -->
    <div class="relative bg-gray-500 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-black tracking-tight">
                    <span class="block">Bienvenido a</span>
                    <span class="block mt-2 text-indigo-400">NovelasApp</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-indigo-300">
                    Descubre historias que transformarán tu mundo.
                </p>
                
                <!-- Buscador con estilo -->
                <div class="mt-10 sm:mt-12">
                    <form action="{{ route('buscar') }}" method="GET" class="max-w-xl mx-auto">
                        <div class="flex rounded-lg shadow-lg overflow-hidden">
                            <div class="relative flex-grow">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="q" 
                                       class="block w-full pl-10 pr-3 py-5 border-0 text-lg focus:ring-0" 
                                       placeholder="Buscar novelas, géneros o autores..." />
                            </div>
                            <button type="submit" class="flex-shrink-0 px-8 py-5 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-medium">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Novelas Destacadas -->
        <div class="mb-16">
            <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Novelas Destacadas</h2>
                <a href="{{ route('novelas.publico.index', ['orden' => 'populares']) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    Ver todas <i class="fas fa-long-arrow-alt-right ml-2"></i>
                </a>
            </div>
            
            @if($destacadas->isNotEmpty())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach($destacadas as $novela)
                        <div class="group relative">
                            <a href="{{ route('novelas.publico.show', $novela) }}" class="block">
                                <div class="relative aspect-[2/3] overflow-hidden rounded-lg shadow-md bg-gray-100">
                                    <!-- Imagen con overlay y efectos -->
                                    <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                         alt="{{ $novela->titulo }}" 
                                         class="h-full w-full object-cover object-center group-hover:opacity-90 transition-opacity duration-300">
                                    
                                    <!-- Información en overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-80"></div>
                                    <div class="absolute bottom-0 left-0 w-full p-4">
                                        <h3 class="text-white font-semibold text-lg truncate mb-1">
                                            {{ Str::limit($novela->titulo, 40) }}
                                        </h3>
                                        <p class="text-gray-300 text-sm mb-2">{{ $novela->user->name }}</p>
                                        <div class="flex text-xs text-gray-300">
                                            <span class="flex items-center mr-3">
                                                <i class="fas fa-eye mr-1"></i> {{ number_format($novela->visitas) }}
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-book mr-1"></i> {{ $novela->capitulos()->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg p-12 text-center shadow">
                    <i class="fas fa-book-open text-5xl text-indigo-200 mb-4"></i>
                    <p class="text-xl text-gray-600">No hay novelas destacadas disponibles aún</p>
                </div>
            @endif
        </div>
        
        <!-- Explorar por Géneros -->
        <div class="mb-16">
            <div class="border-b border-gray-200 pb-6 mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Explora por Géneros</h2>
            </div>
            
            <div class="flex flex-wrap gap-4">
                @foreach($generos as $genero)
                    <a href="{{ route('generos.publico.show', $genero) }}" 
                       class="bg-indigo-200 px-6 py-4 rounded-lg shadow hover:shadow-md transition-shadow flex-grow text-center border-l-4 border-indigo-500">
                        <h3 class="font-semibold text-gray-900 text-lg mb-1">{{ $genero->nombre }}</h3>
                        <p class="text-gray-500 text-sm">{{ $genero->novelas_count }} novelas</p>
                    </a>
                @endforeach
            </div>
        </div>
        
        <!-- Dos columnas para las últimas secciones -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Novelas Recientes -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-5 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Novelas Recientes</h2>
                    <a href="{{ route('novelas.publico.index', ['orden' => 'recientes']) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                        Ver todas <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                @if($recientes->isNotEmpty())
                    <div class="space-y-6">
                        @foreach($recientes->take(4) as $novela)
                            <a href="{{ route('novelas.publico.show', $novela) }}" class="block group">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-16 h-20 bg-gray-100 rounded overflow-hidden">
                                        <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                             alt="{{ $novela->titulo }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="ml-4 flex-grow">
                                        <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">
                                            {{ Str::limit($novela->titulo, 45) }}
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ $novela->user->name }}</p>
                                        <div class="text-xs text-gray-400 mt-1">
                                            <i class="fas fa-calendar-alt mr-1"></i> {{ $novela->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">No hay novelas recientes disponibles</p>
                    </div>
                @endif
            </div>
            
            <!-- Actualizadas Recientemente -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-5 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Recién Actualizadas</h2>
                    <a href="{{ route('novelas.publico.index', ['orden' => 'actualizadas']) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                        Ver todas <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                @if($actualizadas->isNotEmpty())
                    <div class="space-y-6">
                        @foreach($actualizadas->take(4) as $novela)
                            <a href="{{ route('novelas.publico.show', $novela) }}" class="block group">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-16 h-20 bg-gray-100 rounded overflow-hidden">
                                        <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                             alt="{{ $novela->titulo }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="ml-4 flex-grow">
                                        <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">
                                            {{ Str::limit($novela->titulo, 45) }}
                                        </h3>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            @foreach($novela->generos->take(2) as $genero)
                                                <span class="inline-flex text-xs font-medium bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded">
                                                    {{ $genero->nombre }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            <i class="fas fa-sync-alt mr-1"></i> {{ $novela->updated_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">No hay novelas actualizadas recientemente</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- CTA - Unirse como autor -->
        <div class="mt-16 bg-indigo-700 rounded-xl overflow-hidden shadow-xl">
            <div class="px-6 py-12 md:p-12 md:flex md:items-center md:justify-between">
                <div class="max-w-xl">
                    <h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        ¿Te gusta escribir?
                    </h2>
                    <p class="mt-3 text-lg text-indigo-200">
                        Únete a nuestra comunidad y comparte tus historias con miles de lectores.
                    </p>
                </div>
                <div class="mt-8 md:mt-0 md:shrink-0">
                    @if (Auth::check())
                        <a href="{{ route('novelas.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50">
                            <i class="fas fa-pen-fancy mr-2"></i> Escribir nueva novela
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50">
                            <i class="fas fa-user-plus mr-2"></i> Crear una cuenta
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
