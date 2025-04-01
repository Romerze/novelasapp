@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Cabecera del perfil -->
        <div class="bg-indigo-700 px-6 py-8">
            <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center border-4 border-white shadow-md overflow-hidden">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-indigo-100 flex items-center justify-center text-indigo-700">
                            <span class="text-4xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                <div class="text-white">
                    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                    <p class="text-indigo-100 flex items-center mt-2">
                        <i class="fas fa-envelope mr-2"></i>{{ $user->email }}
                    </p>
                    <p class="text-indigo-100 mt-2">
                        <i class="fas fa-calendar mr-2"></i>Miembro desde {{ $user->created_at->format('d M, Y') }}
                    </p>
                </div>
                <div class="md:ml-auto">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center bg-white text-indigo-700 hover:bg-indigo-50 px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-edit mr-2"></i> Editar perfil
                    </a>
                </div>
            </div>
        </div>

        <!-- Estadísticas del usuario -->
        <div class="border-b border-gray-200">
            <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-gray-200">
                <div class="p-6 text-center">
                    <span class="block text-2xl font-bold text-gray-700">{{ $user->novelas->count() }}</span>
                    <span class="text-sm text-gray-500">Novelas</span>
                </div>
                <div class="p-6 text-center">
                    <span class="block text-2xl font-bold text-gray-700">{{ $user->novelas->sum(function($novela) { return $novela->capitulos->count(); }) }}</span>
                    <span class="text-sm text-gray-500">Capítulos</span>
                </div>
                <div class="p-6 text-center">
                    <span class="block text-2xl font-bold text-gray-700">{{ $user->novelas->sum('visitas') }}</span>
                    <span class="text-sm text-gray-500">Visitas</span>
                </div>
                <div class="p-6 text-center">
                    <span class="block text-2xl font-bold text-gray-700">0</span>
                    <span class="text-sm text-gray-500">Seguidores</span>
                </div>
            </div>
        </div>

        <!-- Novelas del usuario -->
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Mis Novelas</h2>
            
            @if($user->novelas->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->novelas as $novela)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <a href="{{ route('novelas.publico.show', $novela) }}">
                                <div class="h-40 bg-gray-300 relative">
                                    @if($novela->imagen_portada)
                                        <img src="{{ asset('storage/' . $novela->imagen_portada) }}" alt="{{ $novela->titulo }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-400 to-purple-500">
                                            <i class="fas fa-book text-white text-4xl"></i>
                                        </div>
                                    @endif
                                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-3">
                                        <h3 class="text-white font-bold truncate">{{ $novela->titulo }}</h3>
                                    </div>
                                </div>
                            </a>
                            <div class="p-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-3">
                                    <span><i class="fas fa-book-open mr-1"></i> {{ $novela->capitulos->count() }} capítulos</span>
                                    <span><i class="fas fa-eye mr-1"></i> {{ number_format($novela->visitas) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $novela->publicada ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $novela->publicada ? 'Publicada' : 'Borrador' }}
                                    </span>
                                    <a href="{{ route('novelas.edit', $novela) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        Editar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-8 text-center">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-book-open text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aún no has creado ninguna novela</h3>
                    <p class="text-gray-600 mb-4">Comienza a compartir tus historias con el mundo.</p>
                    <a href="{{ route('novelas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-medium">
                        <i class="fas fa-plus mr-2"></i> Crear nueva novela
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
