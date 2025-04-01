@extends('layouts.app')

@section('title', 'Crear Nuevo Género')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <a href="{{ route('generos.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Volver a géneros
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-indigo-700 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Crear Nuevo Género</h1>
            </div>
            
            <div class="p-6 sm:p-8">
                <p class="text-gray-600 mb-8">Completa el formulario para crear un nuevo género literario. Los campos marcados con <span class="text-red-500 font-medium">*</span> son obligatorios.</p>
                
                <form action="{{ route('generos.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-8">
                        <div class="form-group">
                            <label for="nombre" class="block mb-3 text-sm font-medium text-gray-900">
                                Nombre del Género <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-bookmark text-gray-400"></i>
                                </div>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-3 @error('nombre') border-red-500 @enderror" 
                                       placeholder="Ej: Ciencia Ficción, Romance, Misterio"
                                       required>
                            </div>
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion" class="block mb-3 text-sm font-medium text-gray-900">
                                Descripción <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="descripcion" id="descripcion" rows="5" 
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 @error('descripcion') border-red-500 @enderror"
                                          placeholder="Describe el género literario y sus características principales"
                                          required>{{ old('descripcion') }}</textarea>
                            </div>
                            @error('descripcion')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="pt-6 mt-6 border-t border-gray-200 flex justify-end gap-4">
                            <a href="{{ route('generos.index') }}" class="text-gray-700 bg-white hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-300 text-sm font-medium px-5 py-2.5 text-center">
                                Cancelar
                            </a>
                            <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <i class="fas fa-save mr-2"></i> Guardar Género
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Información contextual -->
        <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-5 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-md font-medium text-blue-800">Información sobre géneros</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Los géneros ayudan a los lectores a encontrar novelas que coincidan con sus intereses. Al crear un género, asegúrate de que:</p>
                        <ul class="list-disc pl-5 mt-3 space-y-2">
                            <li>El nombre sea descriptivo y reconocible</li>
                            <li>La descripción explique claramente las características del género</li>
                            <li>Sea lo suficientemente específico pero no demasiado restrictivo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
