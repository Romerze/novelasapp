@extends('layouts.app')

@section('title', 'Crear Nueva Novela')

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
                <i class="fas fa-plus-circle text-primary-600 mr-2"></i>Crear Nueva Novela
            </h1>
        </div>
        
        <p class="text-gray-600 mb-6">Completa el formulario para crear una nueva novela. Los campos marcados con <span class="text-danger-600">*</span> son obligatorios.</p>
        
        <form action="{{ route('novelas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-5">
                    <div class="mb-4">
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-700">
                            Título <span class="text-danger-600">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-heading text-gray-400"></i>
                            </div>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 @error('titulo') border-danger-500 @enderror" 
                                   placeholder="Ingresa el título de tu novela"
                                   required>
                        </div>
                        @error('titulo')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="sinopsis" class="block mb-2 text-sm font-medium text-gray-700">
                            Sinopsis <span class="text-danger-600">*</span>
                        </label>
                        <textarea name="sinopsis" id="sinopsis" rows="4" 
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 @error('sinopsis') border-danger-500 @enderror" 
                                  placeholder="Describe tu novela brevemente. Esta sinopsis aparecerá en la página principal."
                                  required>{{ old('sinopsis') }}</textarea>
                        @error('sinopsis')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="autor" class="block mb-2 text-sm font-medium text-gray-700">
                            Autor <span class="text-danger-600">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-edit text-gray-400"></i>
                            </div>
                            <input type="text" name="autor" id="autor" value="{{ old('autor') }}" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 @error('autor') border-danger-500 @enderror" 
                                   placeholder="Nombre del autor"
                                   required>
                        </div>
                        @error('autor')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Género <span class="text-danger-600">*</span>
                        </label>
                        <select name="genero_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 @error('genero_id') border-danger-500 @enderror">
                            <option value="">Selecciona un género</option>
                            @foreach($generos as $genero)
                                <option value="{{ $genero->id }}" {{ old('genero_id') == $genero->id ? 'selected' : '' }}>
                                    {{ $genero->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('genero_id')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <div class="mb-5">
                        <label for="imagen_portada" class="block mb-2 text-sm font-medium text-gray-700">Imagen de Portada</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer">
                            <div class="space-y-2 text-center">
                                <div class="mx-auto">
                                    <img id="preview" class="hidden mx-auto h-32 w-auto object-cover rounded-md mb-2">
                                    <div id="placeholder" class="mx-auto flex items-center justify-center h-32 w-24 text-gray-400">
                                        <i class="fas fa-book-open text-4xl"></i>
                                    </div>
                                </div>
                                <div class="flex text-sm text-gray-600">
                                    <label for="imagen_portada" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-700 focus-within:outline-none">
                                        <span>Seleccionar imagen</span>
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
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <div class="p-4 bg-info-50 border-l-4 border-info-600 text-sm rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-info-600"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-800">Consejos para tu novela</h3>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li>Utiliza un título llamativo y único</li>
                                            <li>La sinopsis debe ser concisa pero informativa</li>
                                            <li>Una buena imagen de portada atraerá más lectores</li>
                                            <li>Selecciona el género adecuado para tu historia</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-5 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="flex items-center">
                            <input type="checkbox" name="publicada" id="publicada" value="1" 
                                   class="w-4 h-4 text-success-600 bg-gray-100 border-gray-300 rounded focus:ring-success-600 focus:ring-2"
                                   {{ old('publicada') ? 'checked' : '' }}>
                            <label for="publicada" class="ml-2 text-sm font-medium text-gray-700">Publicar inmediatamente</label>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Si no marcas esta opción, la novela quedará guardada como borrador y podrás publicarla más tarde.</p>
                    </div>
                </div>
            </div>
            
            <div class="pt-5 mt-6 border-t border-gray-200 flex flex-wrap justify-end gap-3">
                <a href="{{ route('novelas.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                    <i class="fas fa-save mr-2"></i>Guardar Novela
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
