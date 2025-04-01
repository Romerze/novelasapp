@extends('layouts.app')

@section('title', $novela->titulo)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('novelas.publico.index') }}" class="text-primary-600 hover:text-primary-700">
                <i class="fas fa-arrow-left mr-2"></i> Volver a novelas
            </a>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-primary-600 to-secondary-600 p-6 text-white">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4 flex justify-center md:justify-start mb-6 md:mb-0">
                        <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                            alt="{{ $novela->titulo }}" class="w-48 h-64 object-cover rounded-lg shadow-lg">
                    </div>
                    <div class="md:w-3/4 md:pl-8">
                        <h1 class="text-3xl font-bold mb-2 text-gray-800">{{ $novela->titulo }}</h1>
                        <div class="flex items-center mb-4">
                            <div class="flex items-center text-gray-400">
                                <i class="fas fa-user-edit mr-2"></i>
                                <span class="font-medium">{{ $novela->user->name }}</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($novela->generos as $genero)
                                <a href="{{ route('generos.publico.show', $genero) }}" class="bg-white text-primary-700 font-medium px-3 py-1 rounded-full text-sm hover:bg-gray-100">
                                    {{ $genero->nombre }}
                                </a>
                            @endforeach
                        </div>
                        
                        <div class="flex flex-wrap text-sm mb-4">
                            <div class="bg-white text-gray-700 px-3 py-1 rounded-full mr-3 flex items-center">
                                <i class="fas fa-book text-primary-600 mr-1"></i> {{ $novela->capitulos()->count() }} capítulos
                            </div>
                            <div class="bg-white text-gray-700 px-3 py-1 rounded-full mr-3 flex items-center">
                                <i class="fas fa-eye text-primary-600 mr-1"></i> {{ number_format($novela->visitas) }} visitas
                            </div>
                            <div class="bg-white text-gray-700 px-3 py-1 rounded-full flex items-center">
                                <i class="fas fa-calendar-alt text-primary-600 mr-1"></i> {{ $novela->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        
                        <p class="text-gray-700 leading-relaxed">{{ $novela->descripcion }}</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 bg-gray-300">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Capítulos</h2>
                
                @if($capitulos->count() > 0)
                    <div class="bg-gray-100 divide-y divide-gray-200">
                        @foreach($capitulos as $capitulo)
                            <a href="{{ route('capitulos.publico.show', [$novela, $capitulo]) }}" class="block py-4 px-2 hover:bg-gray-50 rounded transition">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="font-medium text-lg text-gray-800">Capítulo {{ $capitulo->numero_capitulo }}: {{ $capitulo->titulo }}</h3>
                                        <div class="flex flex-wrap text-xs text-gray-500 mt-1">
                                            <div class="bg-black text-white px-3 py-1 rounded-full mr-3 flex items-center">
                                                <i class="fas fa-calendar-alt text-white mr-1"></i> {{ $capitulo->created_at->format('d/m/Y') }}
                                            </div>
                                            <div class="bg-black text-white px-3 py-1 rounded-full flex items-center">
                                                <i class="fas fa-eye text-white mr-1"></i> {{ number_format($capitulo->visitas) }} visitas
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right text-primary-600"></i>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $capitulos->links() }}
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-book text-4xl mb-3"></i>
                            <h3 class="text-lg font-medium">No hay capítulos disponibles</h3>
                            <p class="mt-1">El autor aún no ha publicado capítulos para esta novela</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Novelas similares</h2>
            
            @if($novelasSimilares->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($novelasSimilares as $novelaSimilar)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                            <a href="{{ route('novelas.publico.show', $novelaSimilar) }}">
                                <img src="{{ $novelaSimilar->imagen_portada ? asset('storage/' . $novelaSimilar->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                    alt="{{ $novelaSimilar->titulo }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-800 truncate">{{ $novelaSimilar->titulo }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $novelaSimilar->user->name }}</p>
                                    <div class="mt-2 flex items-center text-xs text-gray-500">
                                        <span class="bg-white text-gray-700 px-3 py-1 rounded-full mr-3 flex items-center">
                                            <i class="fas fa-book text-primary-600 mr-1"></i> {{ $novelaSimilar->capitulos()->count() }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <div class="text-gray-500">
                        <p>No hay novelas similares disponibles</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
