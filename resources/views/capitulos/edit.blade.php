@extends('layouts.app')

@section('title', 'Editar Capítulo - ' . $capitulo->titulo)

@section('content')
    <div class="mb-8">
        <a href="{{ route('novelas.capitulos.index', $novela) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Volver a la lista de capítulos
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-4">
                <i class="fas fa-edit"></i>
            </div>
            <div>
                <h1 class="text-2xl font-serif font-bold text-gray-800">Editar Capítulo</h1>
                <p class="text-gray-600">Novela: <a href="{{ route('novelas.show', $novela) }}" class="text-primary-600 hover:underline">{{ $novela->titulo }}</a></p>
            </div>
        </div>
        
        <form action="{{ route('novelas.capitulos.update', [$novela, $capitulo]) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            
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
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $capitulo->titulo) }}" 
                                   class="form-control pl-10 @error('titulo') border-danger-600 @enderror" 
                                   placeholder="Ej: El comienzo de la aventura"
                                   required>
                        </div>
                        @error('titulo')
                            <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="numero_capitulo" class="form-label">
                            Número de Capítulo <span class="text-danger-600">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-sort-numeric-down text-gray-400"></i>
                            </div>
                            <input type="number" name="numero_capitulo" id="numero_capitulo" value="{{ old('numero_capitulo', $capitulo->numero_capitulo) }}" 
                                   class="form-control pl-10 @error('numero_capitulo') border-danger-600 @enderror" 
                                   required min="1">
                        </div>
                        @error('numero_capitulo')
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
                            required>{{ old('contenido', $capitulo->contenido) }}</textarea>
                    @error('contenido')
                        <p class="text-danger-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                    <div class="flex items-center">
                        <input type="checkbox" name="publicado" id="publicado" value="1" 
                               class="rounded border-gray-300 text-success-600 shadow-sm focus:border-success-600 focus:ring focus:ring-success-400 focus:ring-opacity-50"
                               {{ old('publicado', $capitulo->publicado) ? 'checked' : '' }}>
                        <label for="publicado" class="ml-2 text-sm font-medium text-gray-700">Capítulo publicado</label>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Si desmarcas esta opción, el capítulo quedará como borrador y no será visible para los lectores.</p>
                </div>
            </div>
            
            <div class="pt-6 mt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('novelas.capitulos.index', $novela) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                    <i class="fas fa-save mr-2"></i>Guardar Cambios
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.4.2/tinymce.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Inicializando editor TinyMCE');
        
        // Agregar mensaje temporal para debugging
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            console.log('Enviando formulario');
            
            // Asegurarnos que TinyMCE actualice el textarea antes de enviar
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
                console.log('Contenido actualizado desde TinyMCE');
            }
        });
        
        // Inicializar TinyMCE para el editor de texto enriquecido
        tinymce.init({
            selector: '#contenido',
            height: 500,
            menubar: true,
            promotion: false,
            branding: false,
            language: 'es',
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
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            },
            
            // Configuración para subida de imágenes directa sin diálogo
            automatic_uploads: true,
            
            // Manejo personalizado de errores
            images_upload_handler: function (blobInfo, progress) {
                return new Promise((resolve, reject) => {
                    var xhr, formData;
                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = true;
                    xhr.open('POST', '{{ route("novelas.capitulos.imagenes.store", [$novela, $capitulo]) }}');
                    
                    // CSRF token en header
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    
                    xhr.upload.onprogress = function (e) {
                        progress(e.loaded / e.total * 100);
                    };
                    
                    xhr.onload = function() {
                        var json;
                        
                        if (xhr.status === 403) {
                            reject('Error de permisos: ' + xhr.status);
                            return;
                        }
                        
                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('Error HTTP: ' + xhr.status);
                            return;
                        }
                        
                        try {
                            json = JSON.parse(xhr.responseText);
                        } catch (e) {
                            reject('Respuesta inválida: ' + xhr.responseText);
                            return;
                        }
                        
                        if (!json || typeof json.location != 'string') {
                            reject('URL no encontrada en ' + xhr.responseText);
                            return;
                        }
                        
                        resolve(json.location);
                    };
                    
                    xhr.onerror = function () {
                        reject('Error de red');
                    };
                    
                    formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('imagen', blobInfo.blob(), blobInfo.filename());
                    
                    xhr.send(formData);
                });
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
