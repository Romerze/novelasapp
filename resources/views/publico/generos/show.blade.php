@extends('layouts.app')

@section('title', $genero->nombre . ' - Novelas')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('novelas.publico.index') }}" class="text-primary-600 hover:text-primary-700">
                <i class="fas fa-arrow-left mr-2"></i> Volver a géneros
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-primary-600 to-secondary-600 p-6">
                <h1 class="text-2xl md:text-3xl font-bold mb-2 text-gray-600">{{ $genero->nombre }}</h1>
                <p class="text-gray-400 mb-4">{{ $genero->descripcion }}</p>
                <div class="text-sm">
                    <span class="bg-white text-primary-700 font-medium px-3 py-1 rounded-full">{{ $novelas->total() }} novelas</span>
                </div>
            </div>
        </div>
        
        <div class="mb-6">
            <form action="{{ route('generos.publico.show', $genero) }}" method="GET" class="flex max-w-md">
                <input type="text" name="buscar" value="{{ request('buscar') }}" 
                       class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-primary-600 focus:ring focus:ring-primary-300 focus:ring-opacity-50" 
                       placeholder="Buscar en este género...">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-r-md">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        @if($novelas->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 mb-8">
                @foreach($novelas as $novela)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                        <a href="{{ route('novelas.publico.show', $novela) }}">
                            <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                alt="{{ $novela->titulo }}" class="w-full h-56 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 text-lg truncate">{{ $novela->titulo }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $novela->user->name }}</p>
                                <div class="mt-2 flex items-center text-xs text-gray-500">
                                    <span class="flex items-center mr-2">
                                        <i class="fas fa-book mr-1"></i> {{ $novela->capitulos()->count() }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i> {{ number_format($novela->visitas) }}
                                    </span>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i> {{ $novela->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="mb-10">
                {{ $novelas->appends(request()->query())->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-gray-500 mb-6">
                    <i class="fas fa-book-open text-5xl mb-4"></i>
                    <h3 class="text-xl font-medium">No hay novelas disponibles en este género</h3>
                    
                    @if(request()->has('buscar'))
                        <p class="mt-2">No hay resultados para "{{ request('buscar') }}" en este género</p>
                        <div class="mt-4">
                            <a href="{{ route('generos.publico.show', $genero) }}" class="inline-flex items-center bg-primary-600 hover:bg-primary-700 text-white py-2 px-6 rounded-lg">
                                <i class="fas fa-arrow-left mr-2"></i> Ver todas las novelas de este género
                            </a>
                        </div>
                    @else
                        <p class="mt-2">Sé el primero en publicar una novela en este género</p>
                        @auth
                            <div class="mt-4">
                                <a href="{{ route('novelas.create') }}" class="inline-flex items-center bg-primary-600 hover:bg-primary-700 text-white py-2 px-6 rounded-lg">
                                    <i class="fas fa-plus mr-2"></i> Crear nueva novela
                                </a>
                            </div>
                        @else
                            <div class="mt-4">
                                <a href="{{ route('login') }}" class="inline-flex items-center bg-primary-600 hover:bg-primary-700 text-white py-2 px-6 rounded-lg mr-2">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Iniciar sesión
                                </a>
                                <a href="{{ route('register') }}" class="inline-flex items-center bg-primary-600 hover:bg-primary-700 text-white py-2 px-6 rounded-lg">
                                    <i class="fas fa-user-plus mr-2"></i> Registrarse
                                </a>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        @endif
        
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Explora otros géneros</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($otrosGeneros as $otroGenero)
                    <a href="{{ route('generos.publico.show', $otroGenero) }}" 
                       class="bg-indigo-600 {{ $otroGenero->id == $genero->id ? 'from-primary-700 to-secondary-700 border-2 border-primary-300' : 'from-primary-600 to-secondary-600' }} rounded-lg p-4 shadow-md hover:shadow-lg transform transition hover:-translate-y-1">
                        <h3 class="font-bold text-lg mb-1 text-gray-100">{{ $otroGenero->nombre }}</h3>
                        <p class="text-gray-200 text-sm font-medium">{{ $otroGenero->novelas()->count() }} novelas</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
