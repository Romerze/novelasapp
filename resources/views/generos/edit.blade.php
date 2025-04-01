@extends('layouts.app')

@section('title', 'Editar Género')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 hover:text-primary-600 inline-flex items-center">
                        <i class="fas fa-home mr-2.5"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <a href="{{ route('generos.index') }}" class="text-sm text-gray-700 hover:text-primary-600">
                            Géneros
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-sm text-gray-500">Editar {{ $genero->nombre }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Formulario de edición -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="flex items-center border-b border-gray-200 px-6 py-4">
                        <div class="flex-shrink-0 bg-primary-100 p-2 rounded-md text-primary-600 mr-3">
                            <i class="fas fa-edit text-lg"></i>
                        </div>
                        <h1 class="text-xl font-serif font-bold text-gray-800">Editar Género</h1>
                    </div>
                    
                    <div class="p-6">
                        <form action="{{ route('generos.update', $genero) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="space-y-5">
                                <div>
                                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">
                                        Nombre del Género <span class="text-danger-600">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-bookmark text-gray-400"></i>
                                        </div>
                                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $genero->nombre) }}" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 @error('nombre') border-danger-600 @enderror" 
                                            placeholder="Ej: Ciencia Ficción, Romance, Misterio" required>
                                    </div>
                                    @error('nombre')
                                        <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                                        Descripción <span class="text-danger-600">*</span>
                                    </label>
                                    <textarea id="descripcion" name="descripcion" rows="4" 
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-600 focus:border-primary-600 @error('descripcion') border-danger-600 @enderror" 
                                        placeholder="Describe el género literario y sus características principales" required>{{ old('descripcion', $genero->descripcion) }}</textarea>
                                    @error('descripcion')
                                        <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-end space-x-3 mt-6 pt-5 border-t border-gray-200">
                                <a href="{{ route('generos.index') }}" class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-400 rounded-lg border border-gray-300 text-sm font-medium px-5 py-2.5 text-center inline-flex items-center">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                    <i class="fas fa-save mr-2"></i>
                                    Actualizar Género
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Estadísticas del género -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="flex items-center border-b border-gray-200 px-6 py-4">
                        <div class="flex-shrink-0 bg-info-100 p-2 rounded-md text-info-600 mr-3">
                            <i class="fas fa-chart-bar text-lg"></i>
                        </div>
                        <h2 class="text-lg font-medium text-gray-800">Estadísticas</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="p-2 mr-4 bg-primary-100 text-primary-600 rounded-full">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Novelas en este género</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $genero->novelas()->count() }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="p-2 mr-4 bg-info-100 text-info-600 rounded-full">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Última actualización</p>
                                    <p class="text-lg font-medium text-gray-900">{{ $genero->updated_at->format('d/m/Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $genero->updated_at->format('H:i') }} hrs</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="p-2 mr-4 bg-success-100 text-success-600 rounded-full">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Fecha de creación</p>
                                    <p class="text-lg font-medium text-gray-900">{{ $genero->created_at->format('d/m/Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $genero->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex">
                    <a href="{{ route('generos.index') }}" class="text-sm text-primary-600 hover:text-primary-700 flex items-center">
                        <i class="fas fa-arrow-left mr-1.5"></i> Volver a la lista de géneros
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
