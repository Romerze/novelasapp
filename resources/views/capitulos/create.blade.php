@extends('layouts.app')

@section('title', 'Crear Nuevo Capítulo - ' . $novela->titulo)

@section('content')
    <div class="mb-8">
        <a href="{{ route('novelas.capitulos.index', $novela) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Volver a la lista de capítulos
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-4">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <h1 class="text-2xl font-serif font-bold text-gray-800">Crear Nuevo Capítulo</h1>
                <p class="text-gray-600">Para la novela: <span class="font-medium text-gray-800">{{ $novela->titulo }}</span></p>
            </div>
        </div>
        
        <form action="{{ route('novelas.capitulos.store', $novela) }}" method="POST" class="mt-6">
            @csrf
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="titulo" class="form-label">
                            Título del Capítulo <span class="text-danger-600">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-heading text-gray-400"></i>
                            </div>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" 
                                   class="form-control pl-10 @error('titulo') border-danger-600 @enderror" 
                                   placeholder="Ej: El comienzo de la aventura"
                                   required>
                        </div>
                        @error('titulo')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="orden" class="form-label">
                            Número de Capítulo <span class="text-danger-600">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-sort-numeric-down text-gray-400"></i>
                            </div>
                            <input type="number" name="orden" id="orden" value="{{ old('orden', $numero_siguiente) }}" 
                                   class="form-control pl-10 @error('orden') border-danger-600 @enderror" 
                                   required min="1">
                        </div>
                        @error('orden')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="contenido" class="form-label">
                        Contenido <span class="text-danger-600">*</span>
                    </label>
                    <textarea name="contenido" id="contenido" rows="18" 
                            class="form-control font-serif p-4 @error('contenido') border-danger-600 @enderror" 
                            style="min-height: 400px; border-top-left-radius: 0; border-top-right-radius: 0;" 
                            required>{{ old('contenido') }}</textarea>
                    @error('contenido')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="mt-2 p-2 bg-info-100 text-info-700 rounded-md text-sm">
                        <i class="fas fa-info-circle mr-1"></i> Las imágenes podrán ser añadidas después de guardar el capítulo.
                    </div>
                </div>
                
                <div class="mt-6 bg-secondary-100 border-l-4 border-secondary-600 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-lightbulb text-secondary-600"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-800">Consejos para tu capítulo</h3>
                            <div class="mt-1 text-sm text-gray-600">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Utiliza un título atractivo que despierte la curiosidad</li>
                                    <li>Desarrolla bien las escenas y la personalidad de los personajes</li>
                                    <li>Revisa la ortografía y gramática antes de publicar</li>
                                    <li>Mantén un estilo consistente con los capítulos anteriores</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                    <div class="flex items-center">
                        <input type="checkbox" name="publicado" id="publicado" value="1" 
                               class="rounded border-gray-300 text-success-600 shadow-sm focus:border-success-600 focus:ring focus:ring-success-400 focus:ring-opacity-50"
                               {{ old('publicado', true) ? 'checked' : '' }}>
                        <label for="publicado" class="ml-2 text-sm font-medium text-gray-700">Publicar inmediatamente</label>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Si no marcas esta opción, el capítulo quedará como borrador y no será visible para los lectores.</p>
                </div>
            </div>
            
            <div class="pt-6 mt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('novelas.capitulos.index', $novela) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                    <i class="fas fa-save mr-2"></i>Guardar Capítulo
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.4.2/tinymce.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar TinyMCE para el editor de texto enriquecido
        tinymce.init({
            selector: '#contenido',
            height: 500,
            menubar: true,
            promotion: false,
            branding: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
                'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'image media | removeformat | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 16px; }',
            language: 'es',
            automatic_uploads: true,
            file_picker_types: 'image',
            // Note: For creation, we'll show a message because the chapter needs to be saved first
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    alert('Para añadir imágenes, primero guarda el capítulo. Las imágenes podrán agregarse en la pantalla de edición.');
                }
            }
        });
    });
</script>
@endsection

@section('styles')
<style>
    /* Estilos para el editor básico */
    #contenido {
        width: 100%;
        min-height: 400px;
        padding: 1rem;
        font-family: var(--font-serif);
        line-height: 1.6;
        resize: vertical;
    }
    
    .editor-controls {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        padding: 8px;
    }
    
    .editor-controls button {
        padding: 5px 10px;
        background-color: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .editor-controls button:hover {
        background-color: #e2e8f0;
    }
</style>
@endsection
