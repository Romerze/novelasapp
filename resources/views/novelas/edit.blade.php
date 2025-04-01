@extends('layouts.app')

@section('title', 'Editar Novela')

@section('content')
    <div class="mb-4">
        <a href="{{ route('novelas.index') }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700">
            <i class="fas fa-arrow-left mr-2"></i> Volver a mis novelas
        </a>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-100 p-6">
        <!-- Encabezado de página -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h1 class="text-2xl font-serif font-bold text-gray-800 mb-2 sm:mb-0 flex items-center">
                <i class="fas fa-edit text-primary-500 mr-2"></i>Editar Novela
            </h1>
        </div>
        
        <p class="text-gray-600 mb-6">Modifica los datos de tu novela. Los campos marcados con <span class="text-red-500">*</span> son obligatorios.</p>
        
        <form action="{{ route('novelas.update', $novela) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-5">
                    <div class="mb-4">
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-700">
                            Título <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-heading text-gray-400"></i>
                            </div>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $novela->titulo) }}" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 @error('titulo') border-red-500 @enderror" 
                                   placeholder="Ingresa el título de tu novela"
                                   required>
                        </div>
                        @error('titulo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="sinopsis" class="block mb-2 text-sm font-medium text-gray-700">
                            Sinopsis <span class="text-red-500">*</span>
                        </label>
                        <textarea name="sinopsis" id="sinopsis" rows="4" 
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('sinopsis') border-red-500 @enderror" 
                                  placeholder="Describe tu novela brevemente. Esta sinopsis aparecerá en la página principal."
                                  required>{{ old('sinopsis', $novela->sinopsis) }}</textarea>
                        @error('sinopsis')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="autor" class="block mb-2 text-sm font-medium text-gray-700">
                            Autor <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-edit text-gray-400"></i>
                            </div>
                            <input type="text" name="autor" id="autor" value="{{ old('autor', $novela->autor) }}" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 @error('autor') border-red-500 @enderror" 
                                   placeholder="Nombre del autor"
                                   required>
                        </div>
                        @error('autor')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Género <span class="text-red-500">*</span>
                        </label>
                        <select name="genero_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error('genero_id') border-red-500 @enderror">
                            <option value="">Selecciona un género</option>
                            @foreach($generos as $genero)
                                <option value="{{ $genero->id }}" {{ old('genero_id', $novela->genero_id) == $genero->id ? 'selected' : '' }}>
                                    {{ $genero->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('genero_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <div class="mb-5">
                        <label for="imagen_portada" class="block mb-2 text-sm font-medium text-gray-700">Imagen de Portada</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer">
                            <div class="space-y-2 text-center">
                                <div class="mx-auto">
                                    <img id="preview" src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : '' }}" 
                                        class="{{ $novela->imagen_portada ? '' : 'hidden' }} mx-auto h-32 w-auto object-cover rounded-md mb-2">
                                    <div id="placeholder" class="{{ $novela->imagen_portada ? 'hidden' : '' }} mx-auto flex items-center justify-center h-32 w-24 text-gray-400">
                                        <i class="fas fa-book-open text-4xl"></i>
                                    </div>
                                </div>
                                <div class="flex text-sm text-gray-600">
                                    <label for="imagen_portada" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-500 hover:text-primary-600 focus-within:outline-none">
                                        <span>Cambiar imagen</span>
                                        <input id="imagen_portada" name="imagen_portada" type="file" class="sr-only" accept="image/*" onchange="previewImage()">
                                    </label>
                                    <p class="pl-1">o arrastra y suelta</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF hasta 2MB
                                </p>
                            </div>
                        </div>
                        @error('imagen_portada')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <div class="p-4 bg-purple-50 border-l-4 border-secondary-500 text-sm rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-chart-bar text-secondary-500"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-800">Estadísticas de la novela</h3>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                                <span>Creada: {{ $novela->created_at->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-book-open mr-2 text-gray-400"></i>
                                                <span>{{ $novela->capitulos()->count() }} capítulos</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-eye mr-2 text-gray-400"></i>
                                                <span>{{ $novela->visitas ?? 0 }} visitas</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas {{ $novela->publicada ? 'fa-check-circle text-success-500' : 'fa-clock text-warning-500' }} mr-2"></i>
                                                <span>{{ $novela->publicada ? 'Publicada' : 'Borrador' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-5 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="flex items-center">
                            <input type="checkbox" name="publicada" id="publicada" value="1" 
                                   class="w-4 h-4 text-success-500 bg-gray-100 border-gray-300 rounded focus:ring-success-500 focus:ring-2"
                                   {{ old('publicada', $novela->publicada) ? 'checked' : '' }}>
                            <label for="publicada" class="ml-2 text-sm font-medium text-gray-700">Publicada</label>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Marca esta casilla para que la novela sea pública. Desmárcala para guardarla como borrador.</p>
                    </div>
                </div>
            </div>
            
            <div class="pt-5 mt-6 border-t border-gray-200 flex flex-wrap justify-end gap-3">
                <a href="{{ route('novelas.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-500 rounded-md shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-300">
                    <i class="fas fa-save mr-2"></i>Actualizar Novela
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function previewImage() {
        const input = document.getElementById('imagen_portada');
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }
</script>
@endsection
