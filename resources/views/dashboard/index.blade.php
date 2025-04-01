@extends('layouts.app')

@section('title', 'Dashboard - Mi Panel de Control')

@section('content')
    <!-- Encabezado de página -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-5">
        <h1 class="text-2xl font-serif font-bold text-gray-800 mb-2 sm:mb-0">
            <i class="fas fa-tachometer-alt text-primary-500 mr-2"></i>Panel de Control
        </h1>
        <div class="flex space-x-2">
            <a href="{{ route('novelas.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-primary-500 rounded-md shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-300">
                <i class="fas fa-plus mr-2"></i> Nueva Novela
            </a>
        </div>
    </div>
    
    <!-- Tarjetas de estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-2.5 rounded-full bg-blue-50 text-primary-500 mr-4">
                    <i class="fas fa-book text-lg"></i>
                </div>
                <div>
                    <p class="text-xs uppercase font-medium text-gray-500">Mis Novelas</p>
                    <p class="text-2xl font-bold text-gray-700">{{ $totalNovelas }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-2.5 rounded-full bg-green-50 text-success-500 mr-4">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
                <div>
                    <p class="text-xs uppercase font-medium text-gray-500">Publicadas</p>
                    <p class="text-2xl font-bold text-gray-700">{{ $novelasPublicadas }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-2.5 rounded-full bg-purple-50 text-secondary-600 mr-4">
                    <i class="fas fa-file-alt text-lg"></i>
                </div>
                <div>
                    <p class="text-xs uppercase font-medium text-gray-500">Capítulos</p>
                    <p class="text-2xl font-bold text-gray-700">{{ $totalCapitulos }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-2.5 rounded-full bg-indigo-50 text-info-500 mr-4">
                    <i class="fas fa-eye text-lg"></i>
                </div>
                <div>
                    <p class="text-xs uppercase font-medium text-gray-500">Visitas Totales</p>
                    <p class="text-2xl font-bold text-gray-700">{{ number_format($totalVisitas) }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Acciones Rápidas -->
        <div class="bg-white rounded-lg shadow p-5 border border-gray-100 lg:col-span-1">
            <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-2"></i>Acciones Rápidas
            </h2>
            <div class="space-y-2">
                <a href="{{ route('novelas.create') }}" class="flex items-center p-3 rounded-md bg-gray-50 hover:bg-gray-100 text-gray-700 transition-colors">
                    <div class="p-2 rounded-full bg-primary-50 text-primary-500 mr-3">
                        <i class="fas fa-plus"></i>
                    </div>
                    <span class="font-medium">Nueva Novela</span>
                </a>
                <a href="{{ route('novelas.index') }}" class="flex items-center p-3 rounded-md bg-gray-50 hover:bg-gray-100 text-gray-700 transition-colors">
                    <div class="p-2 rounded-full bg-secondary-50 text-secondary-600 mr-3">
                        <i class="fas fa-edit"></i>
                    </div>
                    <span class="font-medium">Administrar Novelas</span>
                </a>
                <a href="{{ route('generos.index') }}" class="flex items-center p-3 rounded-md bg-gray-50 hover:bg-gray-100 text-gray-700 transition-colors">
                    <div class="p-2 rounded-full bg-info-50 text-info-500 mr-3">
                        <i class="fas fa-tags"></i>
                    </div>
                    <span class="font-medium">Gestionar Géneros</span>
                </a>
            </div>
        </div>

        <!-- Últimas novelas -->
        <div class="bg-white rounded-lg shadow p-5 border border-gray-100 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-800 flex items-center">
                    <i class="fas fa-book text-primary-500 mr-2"></i>Mis Últimas Novelas
                </h2>
                <a href="{{ route('novelas.index') }}" class="text-sm text-primary-500 hover:text-primary-700 font-medium">
                    Ver todas <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            @if($ultimasNovelas->count() > 0)
                <div class="space-y-4">
                    @foreach($ultimasNovelas as $novela)
                        <div class="flex items-center p-3 rounded-md bg-gray-50 hover:bg-gray-100 transition-colors">
                            <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                 alt="{{ $novela->titulo }}" class="w-12 h-16 object-cover rounded shadow mr-3">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-medium text-gray-800">{{ $novela->titulo }}</h3>
                                <div class="flex flex-wrap mt-1 gap-2">
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-800">
                                        <i class="fas fa-file-alt mr-1 text-secondary-500"></i>{{ $novela->capitulos()->count() }}
                                    </span>
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-800">
                                        <i class="fas fa-eye mr-1 text-info-500"></i>{{ number_format($novela->visitas) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <a href="{{ route('novelas.show', $novela) }}" class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-md" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('novelas.edit', $novela) }}" class="p-1.5 text-yellow-500 hover:bg-yellow-50 rounded-md" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('novelas.capitulos.index', $novela) }}" class="p-1.5 text-purple-500 hover:bg-purple-50 rounded-md" title="Capítulos">
                                    <i class="fas fa-list-ul"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 bg-gray-50 rounded-lg">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 text-gray-400 mb-3">
                        <i class="fas fa-book text-xl"></i>
                    </div>
                    <p class="text-gray-600">No has creado ninguna novela aún.</p>
                    <a href="{{ route('novelas.create') }}" class="mt-3 inline-flex items-center text-sm font-medium text-primary-500 hover:text-primary-600">
                        <i class="fas fa-plus mr-1"></i> Crear primera novela
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Últimos capítulos -->
    <div class="bg-white rounded-lg shadow p-5 border border-gray-100 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-medium text-gray-800 flex items-center">
                <i class="fas fa-file-alt text-secondary-600 mr-2"></i>Mis Últimos Capítulos
            </h2>
        </div>
        
        @if($ultimosCapitulos->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($ultimosCapitulos as $capitulo)
                    <div class="py-3">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h3 class="font-medium text-gray-800">{{ $capitulo->titulo }}</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <a href="{{ route('novelas.show', $capitulo->novela) }}" class="text-primary-500 hover:underline">
                                        {{ $capitulo->novela->titulo }}
                                    </a>
                                    <span class="mx-1">•</span>
                                    <span>Capítulo {{ $capitulo->numero_capitulo }}</span>
                                    <span class="mx-1">•</span>
                                    <span>{{ $capitulo->created_at->format('d/m/Y') }}</span>
                                </p>
                            </div>
                            <div class="mt-2 sm:mt-0 flex items-center text-sm text-gray-500">
                                <span class="flex items-center mr-3">
                                    <i class="fas fa-eye text-info-500 mr-1"></i> {{ number_format($capitulo->visitas) }}
                                </span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('novelas.capitulos.show', [$capitulo->novela, $capitulo]) }}" class="text-blue-500 hover:text-blue-700" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('novelas.capitulos.edit', [$capitulo->novela, $capitulo]) }}" class="text-yellow-500 hover:text-yellow-700" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-6 bg-gray-50 rounded-lg">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 text-gray-400 mb-3">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                <p class="text-gray-600">No has creado ningún capítulo aún.</p>
            </div>
        @endif
    </div>
@endsection
