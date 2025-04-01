@extends('layouts.app')

@section('title', $genero->nombre . ' - Novelas')

@section('content')
    <div class="mb-6 flex items-center">
        <a href="{{ route('generos.index') }}" class="text-primary-600 hover:text-primary-800 flex items-center transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Volver a géneros
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8 border border-gray-100">
        <div class="bg-gradient-to-r from-primary-600 to-secondary-600 p-8">
            <h1 class="text-3xl font-bold mb-4 flex items-center text-gray-600">
                <i class="fas fa-tag mr-3 opacity-75"></i>{{ $genero->nombre }}
            </h1>
            <p class="text-gray-400 mb-6 max-w-3xl">{{ $genero->descripcion }}</p>
            <div class="flex items-center space-x-4">
                <span class="bg-white text-primary-700 px-4 py-2 rounded-full flex items-center font-medium">
                    <i class="fas fa-book mr-2"></i>{{ $novelas->total() }} novelas
                </span>
                <span class="bg-white text-primary-700 px-4 py-2 rounded-full flex items-center font-medium">
                    <i class="fas fa-calendar-alt mr-2"></i>Creado el {{ $genero->created_at->format('d/m/Y') }}
                </span>
            </div>
        </div>
        @can('update', $genero)
            <div class="bg-gray-50 px-8 py-3 border-t border-gray-100 flex justify-end space-x-3">
                <a href="{{ route('generos.edit', $genero) }}" class="inline-flex items-center px-4 py-2 bg-warning-100 hover:bg-warning-200 text-warning-700 text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>Editar género
                </a>
                <button type="button" 
                      onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar este género?')) document.getElementById('delete-form').submit();" 
                      class="inline-flex items-center px-4 py-2 bg-danger-100 hover:bg-danger-200 text-danger-700 text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-trash-alt mr-2"></i>Eliminar
                </button>
                <form id="delete-form" action="{{ route('generos.destroy', $genero) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        @endcan
    </div>
    
    <div class="mb-8">
        <h2 class="page-heading flex items-center">
            <i class="fas fa-book text-primary-600 mr-3"></i>Novelas de {{ $genero->nombre }}
        </h2>
    </div>
    
    @if($novelas->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
            @foreach($novelas as $novela)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all hover:-translate-y-1 hover:shadow-lg border border-gray-100 hover:border-primary-300 card">
                    <a href="{{ route('novelas.show', $novela) }}" class="block">
                        <div class="aspect-w-2 aspect-h-3 overflow-hidden bg-gray-100">
                            <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                alt="{{ $novela->titulo }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">{{ $novela->titulo }}</h3>
                            <p class="text-sm text-gray-500 mb-2">
                                <i class="fas fa-user text-gray-400 mr-1"></i> {{ $novela->autor }}
                            </p>
                            @if($novela->capitulos_count > 0)
                                <span class="text-xs bg-primary-100 text-primary-700 px-2 py-1 rounded-full inline-flex items-center">
                                    <i class="fas fa-list-ul mr-1"></i> {{ $novela->capitulos_count }} capítulos
                                </span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full inline-flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Sin capítulos
                                </span>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $novelas->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                <i class="fas fa-book-open text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay novelas en este género</h3>
            <p class="text-gray-500 mb-6">Aún no se ha añadido ninguna novela a {{ $genero->nombre }}</p>
            
            @can('create', App\Models\Novela::class)
                <a href="{{ route('novelas.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors shadow inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Crear Nueva Novela
                </a>
            @endcan
        </div>
    @endif
@endsection
