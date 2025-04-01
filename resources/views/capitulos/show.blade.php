@extends('layouts.app')

@section('title', $capitulo->titulo . ' - ' . $novela->titulo)

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div class="mb-4 sm:mb-0">
            <a href="{{ route('novelas.show', $novela) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Volver a la novela
            </a>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('novelas.capitulos.index', $novela) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400">
                <i class="fas fa-list mr-1.5"></i> Índice
            </a>
            
            @can('update', $novela)
                <a href="{{ route('novelas.capitulos.edit', [$novela, $capitulo]) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-secondary-600 rounded-md shadow-sm hover:bg-secondary-700 focus:outline-none focus:ring-2 focus:ring-secondary-400">
                    <i class="fas fa-edit mr-1.5"></i> Editar
                </a>
            @endcan
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <!-- Cabecera del capítulo -->
        <div class="bg-gradient-to-r from-primary-500 to-primary-600 text-black p-8">
            <div class="flex items-center mb-2 text-primary-500">
                <a href="{{ route('novelas.show', $novela) }}" class="hover:text-primary-700 transition-colors">{{ $novela->titulo }}</a>
                <i class="fas fa-angle-right mx-2 text-primary-500/200"></i>
                <span>Capítulo {{ $capitulo->numero_capitulo }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-serif font-bold mb-2">{{ $capitulo->titulo }}</h1>
            
            @if(!empty($capitulo->resumen))
                <p class="text-primary-100 italic mt-3 mb-4 text-lg">{{ $capitulo->resumen }}</p>
            @endif
            
            <div class="mt-4 flex flex-wrap items-center text-sm border-t border-primary-100/30 pt-4">
                <div class="flex items-center mr-4 text-primary-700">
                    <i class="fas fa-user mr-1.5"></i> {{ $novela->user->name }}
                </div>
                <div class="flex items-center mr-4 text-secondary-700">
                    <i class="fas fa-calendar-alt mr-1.5"></i> {{ $capitulo->created_at->format('d M, Y') }}
                </div>
                <div class="flex items-center text-primary-700">
                    <i class="fas fa-eye mr-1.5"></i> {{ number_format($capitulo->visitas) }} lecturas
                </div>
            </div>
        </div>
        
        <!-- Navegación entre capítulos -->
        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 flex justify-between items-center text-sm">
            <div>
                @if($capitulo_anterior)
                    <a href="{{ route('novelas.capitulos.show', [$novela, $capitulo_anterior]) }}" class="text-gray-600 hover:text-primary-600 flex items-center transition-colors">
                        <i class="fas fa-chevron-left mr-1.5"></i> Capítulo anterior
                    </a>
                @else
                    <span class="text-gray-400"><i class="fas fa-chevron-left mr-1.5"></i> Primer capítulo</span>
                @endif
            </div>
            
            <div class="font-medium bg-gray-200 px-3 py-1 rounded-full text-gray-700 text-xs">
                Capítulo {{ $capitulo->numero_capitulo }} / {{ $listaCapitulos->count() }}
            </div>
            
            <div>
                @if($capitulo_siguiente)
                    <a href="{{ route('novelas.capitulos.show', [$novela, $capitulo_siguiente]) }}" class="text-gray-600 hover:text-primary-600 flex items-center transition-colors">
                        Capítulo siguiente <i class="fas fa-chevron-right ml-1.5"></i>
                    </a>
                @else
                    <span class="text-gray-400">Último capítulo <i class="fas fa-chevron-right ml-1.5"></i></span>
                @endif
            </div>
        </div>
        
        <!-- Contenido del capítulo -->
        <div class="p-8 max-w-3xl mx-auto">
            <div class="chapter-content prose prose-lg max-w-none">
                {!! $capitulo->contenido !!}
            </div>
        </div>
        
        <!-- Acciones al final del capítulo -->
        <div class="border-t border-gray-200 bg-gray-50 p-6">
            <div class="max-w-3xl mx-auto flex flex-col sm:flex-row sm:justify-between sm:items-center">
                
                <div class="flex space-x-3">
                    @if($capitulo_anterior)
                        <a href="{{ route('novelas.capitulos.show', [$novela, $capitulo_anterior]) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            <i class="fas fa-chevron-left mr-2"></i> Anterior
                        </a>
                    @endif
                    
                    @if($capitulo_siguiente)
                        <a href="{{ route('novelas.capitulos.show', [$novela, $capitulo_siguiente]) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                            Siguiente <i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Índice de capítulos -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
                <i class="fas fa-list-ol"></i>
            </div>
            Índice de capítulos
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($listaCapitulos as $cap)
                <a href="{{ route('novelas.capitulos.show', [$novela, $cap]) }}" 
                   class="flex items-center p-3 rounded-lg transition-all duration-200 {{ $cap->id == $capitulo->id ? 'bg-primary-50 border border-primary-100' : 'hover:bg-gray-50 border border-transparent hover:border-gray-200' }}">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full {{ $cap->id == $capitulo->id ? 'bg-primary-100 text-primary-600' : 'bg-gray-100 text-gray-700' }} mr-3">
                        {{ $cap->numero_capitulo }}
                    </div>
                    <div class="flex-grow min-w-0">
                        <div class="font-medium truncate {{ $cap->id == $capitulo->id ? 'text-primary-600' : 'text-gray-800' }}">
                            {{ $cap->titulo }}
                        </div>
                        <div class="flex items-center text-xs text-gray-500 mt-1">
                            <span class="flex items-center">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ $cap->created_at->format('d/m/Y') }}
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <i class="far fa-eye mr-1"></i>
                                {{ number_format($cap->visitas) }}
                            </span>
                        </div>
                    </div>
                    @if($cap->id == $capitulo->id)
                        <span class="ml-2 flex-shrink-0 text-primary-600">
                            <i class="fas fa-bookmark"></i>
                        </span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endsection

@section('styles')
<style>
    .chapter-content {
        font-family: 'Merriweather', serif;
        line-height: 1.8;
        font-size: 1.125rem;
    }
    
    .chapter-content p {
        margin-bottom: 1.5rem;
    }
    
    .chapter-content p:first-of-type::first-letter {
        font-size: 3.5rem;
        font-weight: 700;
        float: left;
        line-height: 1;
        padding-right: 0.5rem;
        color: var(--color-primary-600);
    }
</style>
@endsection
