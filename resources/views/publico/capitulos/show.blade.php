@extends('layouts.app')

@section('title', $capitulo->titulo . ' - ' . $novela->titulo)

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center">
            <div class="mb-4 sm:mb-0">
                <a href="{{ route('novelas.publico.show', $novela) }}" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a la novela
                </a>
            </div>
            
            <div class="flex space-x-4">
                @if($capituloAnterior)
                    <a href="{{ route('capitulos.publico.show', [$novela, $capituloAnterior]) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-chevron-left mr-2"></i> Anterior
                    </a>
                @endif
                
                @if($capituloSiguiente)
                    <a href="{{ route('capitulos.publico.show', [$novela, $capituloSiguiente]) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg flex items-center">
                        Siguiente <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Cabecera del capítulo -->
            <div class="bg-indigo-700 text-white p-6">
                <div class="flex items-center mb-2">
                    <a href="{{ route('novelas.publico.show', $novela) }}" class="text-indigo-200 hover:text-white">
                        {{ $novela->titulo }}
                    </a>
                    <i class="fas fa-angle-right text-indigo-300 mx-2"></i>
                    <span>Capítulo {{ $capitulo->numero_capitulo }}</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold">{{ $capitulo->titulo }}</h1>
                <div class="mt-4 flex flex-wrap items-center text-sm gap-4">
                    <div class="flex items-center">
                        <i class="fas fa-user mr-1"></i> {{ $novela->user->name }}
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-1"></i> {{ $capitulo->created_at->format('d/m/Y') }}
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-eye mr-1"></i> {{ number_format($capitulo->visitas) }} visitas
                    </div>
                </div>
            </div>
            
            <!-- Contenido del capítulo -->
            <div class="p-8 max-w-3xl mx-auto">
                <div class="chapter-content prose prose-lg max-w-none">
                    {!! $capitulo->contenido !!}
                </div>
                
                @auth
                <div class="mt-8 flex justify-center space-x-6">
                    <form action="{{ route('capitulos.guardar', $capitulo) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-guardar-capitulo flex items-center px-4 py-2 rounded-lg {{ $capitulo->estaGuardadoPorUsuario(auth()->id()) ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }} hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                            <i class="fas {{ $capitulo->estaGuardadoPorUsuario(auth()->id()) ? 'fas' : 'far' }} fa-bookmark mr-2"></i> Guardar
                        </button>
                    </form>
                    
                    <form action="{{ route('capitulos.like', $capitulo) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-like-capitulo flex items-center px-4 py-2 rounded-lg {{ $capitulo->tieneLikeDeUsuario(auth()->id()) ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }} hover:bg-red-50 hover:text-red-600 transition duration-200">
                            <i class="{{ $capitulo->tieneLikeDeUsuario(auth()->id()) ? 'fas' : 'far' }} fa-heart mr-2"></i> Me gusta
                            <span class="ml-1 like-count">{{ $capitulo->usuariosConLike()->count() }}</span>
                        </button>
                    </form>
                </div>
                @else
                <div class="mt-8 flex justify-center space-x-6">
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-bookmark mr-2"></i> Guardar
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-heart mr-2"></i> Me gusta
                    </a>
                </div>
                @endauth
                
                <div class="mt-12 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div class="flex space-x-4 mb-4 sm:mb-0">
                        @if($capituloAnterior)
                            <a href="{{ route('capitulos.publico.show', [$novela, $capituloAnterior]) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg flex items-center">
                                <i class="fas fa-chevron-left mr-2"></i> Capítulo anterior
                            </a>
                        @endif
                        
                        @if($capituloSiguiente)
                            <a href="{{ route('capitulos.publico.show', [$novela, $capituloSiguiente]) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg flex items-center">
                                Capítulo siguiente <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        @endif
                    </div>
                    
                    <div>
                        <a href="{{ route('novelas.publico.show', $novela) }}" class="text-indigo-600 hover:text-indigo-800">
                            Ver índice de capítulos <i class="fas fa-list ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Comentarios o valoraciones (si se implementan en el futuro) -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Índice rápido</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($listaCapitulos as $cap)
                    <a href="{{ route('capitulos.publico.show', [$novela, $cap]) }}" 
                       class="block p-3 rounded-md {{ $cap->id == $capitulo->id ? 'bg-indigo-100 border border-indigo-300' : 'hover:bg-gray-100' }}">
                        <div class="font-medium {{ $cap->id == $capitulo->id ? 'text-indigo-700' : 'text-gray-800' }}">
                            Capítulo {{ $cap->numero_capitulo }}: {{ Str::limit($cap->titulo, 25) }}
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $cap->created_at->format('d/m/Y') }} • {{ number_format($cap->visitas) }} visitas
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
