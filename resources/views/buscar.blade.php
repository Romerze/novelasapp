@extends('layouts.app')

@section('title', 'Resultados de búsqueda: ' . $busqueda)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Resultados de búsqueda</h1>
            <p class="text-gray-600">Se encontraron {{ $novelas->total() }} resultados para "{{ $busqueda }}"</p>
            
            <div class="mt-4 mb-6">
                <form action="{{ route('buscar') }}" method="GET" class="flex max-w-lg">
                    <input type="text" name="q" value="{{ $busqueda }}" 
                        class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                        placeholder="Buscar novelas...">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-r-md">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        
        @if($novelas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                @foreach($novelas as $novela)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <a href="{{ route('novelas.show', $novela) }}" class="flex h-full">
                            <div class="w-1/3 min-h-full">
                                <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                    alt="{{ $novela->titulo }}" class="w-full h-full object-cover">
                            </div>
                            <div class="w-2/3 p-4 flex flex-col">
                                <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $novela->titulo }}</h2>
                                <p class="text-sm text-gray-600">{{ $novela->user->name }}</p>
                                
                                <p class="mt-2 text-gray-700 text-sm line-clamp-2 flex-grow">
                                    {{ Str::limit($novela->descripcion, 150) }}
                                </p>
                                
                                <div class="mt-3 flex flex-wrap gap-1">
                                    @foreach($novela->generos as $genero)
                                        <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">
                                            {{ $genero->nombre }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <div class="mt-2 flex items-center text-xs text-gray-500">
                                    <span class="flex items-center mr-3">
                                        <i class="fas fa-book mr-1"></i> {{ $novela->capitulos()->count() }} capítulos
                                    </span>
                                    <span class="flex items-center mr-3">
                                        <i class="fas fa-eye mr-1"></i> {{ number_format($novela->visitas) }} visitas
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-clock mr-1"></i> Actualizado {{ $novela->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="mb-10">
                {{ $novelas->appends(['q' => $busqueda])->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-gray-500 mb-6">
                    <i class="fas fa-search text-5xl mb-4"></i>
                    <h3 class="text-xl font-medium">No se encontraron resultados</h3>
                    <p class="mt-2">No hay coincidencias para "{{ $busqueda }}"</p>
                    <div class="mt-4">
                        <a href="{{ route('generos.index') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-6 rounded-lg">
                            <i class="fas fa-tags mr-2"></i> Explorar géneros
                        </a>
                    </div>
                </div>
                
                <div class="mt-8 max-w-2xl mx-auto">
                    <h3 class="text-lg font-medium text-gray-700 mb-3">Sugerencias:</h3>
                    <ul class="text-left list-disc list-inside text-gray-600">
                        <li>Revisa la ortografía de lo que has buscado.</li>
                        <li>Intenta utilizar términos más generales.</li>
                        <li>Prueba con palabras clave diferentes.</li>
                    </ul>
                </div>
            </div>
        @endif
        
        <div class="mt-12 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Explora por Géneros</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($generos as $genero)
                    <a href="{{ route('generos.show', $genero) }}" class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white rounded-lg p-4 shadow-md hover:shadow-lg transform transition hover:-translate-y-1">
                        <h3 class="font-bold text-lg mb-1">{{ $genero->nombre }}</h3>
                        <p class="text-indigo-100 text-sm">{{ $genero->novelas()->count() }} novelas</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
