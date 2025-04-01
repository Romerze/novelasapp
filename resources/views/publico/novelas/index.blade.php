@extends('layouts.app')

@section('title', 'Explorar Novelas')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Explorar Novelas</h1>
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-grow">
                    <form action="{{ route('novelas.publico.index') }}" method="GET" class="flex">
                        <input type="text" name="buscar" value="{{ request('buscar') }}" 
                            class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                            placeholder="Buscar novelas...">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-r-md">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                
                <div class="flex flex-wrap gap-2 justify-end">
                    <div class="relative">
                        <select name="orden" onchange="window.location = this.value;" 
                                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm pr-8">
                            <option value="{{ route('novelas.publico.index', ['orden' => 'recientes']) }}" {{ request('orden') == 'recientes' ? 'selected' : '' }}>
                                Más recientes
                            </option>
                            <option value="{{ route('novelas.publico.index', ['orden' => 'populares']) }}" {{ request('orden') == 'populares' ? 'selected' : '' }}>
                                Más populares
                            </option>
                            <option value="{{ route('novelas.publico.index', ['orden' => 'actualizadas']) }}" {{ request('orden') == 'actualizadas' ? 'selected' : '' }}>
                                Recién actualizadas
                            </option>
                        </select>
                    </div>
                </div>
            </div>
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
                                <div class="mt-2 flex flex-wrap gap-1">
                                    @foreach($novela->generos as $genero)
                                        <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">
                                            {{ $genero->nombre }}
                                        </span>
                                    @endforeach
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
                <div class="text-gray-500 mb-4">
                    <i class="fas fa-book-open text-5xl mb-4"></i>
                    <h3 class="text-xl font-medium">No se encontraron novelas</h3>
                    
                    @if(request()->has('buscar'))
                        <p class="mt-2">No hay resultados para "{{ request('buscar') }}"</p>
                        <div class="mt-4">
                            <a href="{{ route('novelas.publico.index') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-6 rounded-lg">
                                <i class="fas fa-arrow-left mr-2"></i> Ver todas las novelas
                            </a>
                        </div>
                    @else
                        <p class="mt-2">Pronto habrá contenido disponible</p>
                    @endif
                </div>
            </div>
        @endif
        
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Explora por Géneros</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($generos as $genero)
                    <a href="{{ route('generos.publico.show', $genero) }}" class="bg-indigo-700 text-white rounded-lg p-4 shadow-md hover:shadow-lg transform transition hover:-translate-y-1">
                        <h3 class="font-bold text-lg mb-1">{{ $genero->nombre }}</h3>
                        <p class="text-indigo-100 text-sm">{{ $genero->novelas()->count() }} novelas</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
