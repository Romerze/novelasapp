@extends('layouts.app')

@section('title', $novela->titulo)

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('novelas.index') }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-800 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Volver a mis novelas
            </a>
        </div>

        <!-- Cabecera de la novela -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden mb-6">
            <div class="bg-primary-600 text-white p-6">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4 flex justify-center mb-6 md:mb-0">
                        <div class="relative">
                            <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                alt="{{ $novela->titulo }}" class="w-48 h-64 object-cover rounded-lg shadow-md border-2 border-white">
                        </div>
                    </div>
                    <div class="md:w-3/4 md:pl-8">
                        <div class="flex flex-wrap items-center mb-3">
                            <h1 class="text-2xl sm:text-3xl font-bold mr-3">{{ $novela->titulo }}</h1>
                            @if($novela->publicada)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check-circle mr-1"></i> Publicada
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-clock mr-1"></i> Borrador
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <span class="flex items-center text-lg text-white">
                                <i class="fas fa-user-circle mr-2"></i>
                                <span class="font-medium">{{ $novela->autor ?? $novela->user->name }}</span>
                                @if($novela->estado == 'borrador')
                                    <span class="ml-3 text-sm text-yellow-200"><i class="fas fa-exclamation-circle mr-1"></i> Solo visible para ti</span>
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-5">
                            @if($novela->generos->count() > 0)
                                @foreach($novela->generos as $genero)
                                <span class="bg-white px-3 py-1 rounded-full text-sm flex items-center text-primary-700 font-medium">
                                    <i class="fas fa-tag mr-1.5 text-primary-600"></i> {{ $genero->nombre }}
                                </span>
                                @endforeach
                            @else
                                <span class="bg-white px-3 py-1 rounded-full text-sm flex items-center text-primary-700 font-medium">
                                    <i class="fas fa-tag mr-1.5 text-primary-600"></i> Sin género
                                </span>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5 text-sm">
                            <div class="bg-white px-3 py-2 rounded-lg flex flex-col items-center text-gray-700 shadow-sm">
                                <i class="fas fa-eye text-xl mb-1 text-primary-600"></i>
                                <span class="font-bold text-lg">{{ number_format($novela->visitas ?? 0) }}</span>
                                <span>Visitas</span>
                            </div>
                            <div class="bg-white px-3 py-2 rounded-lg flex flex-col items-center text-gray-700 shadow-sm">
                                <i class="fas fa-book-open text-xl mb-1 text-primary-600"></i>
                                <span class="font-bold text-lg">{{ $novela->capitulos()->count() }}</span>
                                <span>Capítulos</span>
                            </div>
                            <div class="bg-white px-3 py-2 rounded-lg flex flex-col items-center text-gray-700 shadow-sm">
                                <i class="fas fa-calendar-alt text-xl mb-1 text-primary-600"></i>
                                <span class="font-bold text-lg">{{ $novela->created_at->format('d/m/Y') }}</span>
                                <span>Creación</span>
                            </div>
                            <div class="bg-white px-3 py-2 rounded-lg flex flex-col items-center text-gray-700 shadow-sm">
                                <i class="fas fa-clock text-xl mb-1 text-primary-600"></i>
                                <span class="font-bold text-lg">{{ $novela->updated_at->format('d/m/Y') }}</span>
                                <span>Actualización</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('novelas.edit', $novela) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 rounded-md shadow-sm hover:bg-yellow-700 transition-colors">
                                <i class="fas fa-edit mr-2"></i> Editar novela
                            </a>
                            <a href="{{ route('novelas.capitulos.create', $novela) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i> Añadir capítulo
                            </a>
                            <button type="button" onclick="showDeleteModal()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md shadow-sm hover:bg-red-700 transition-colors">
                                <i class="fas fa-trash-alt mr-2"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenido principal -->
            <div class="p-6">
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-3 flex items-center border-b border-gray-200 pb-2">
                        <i class="fas fa-info-circle text-primary-600 mr-2"></i> Sinopsis
                    </h2>
                    <div class="prose max-w-none text-gray-700 bg-gray-50 p-4 rounded-md border border-gray-200">
                        @if($novela->sinopsis)
                            <p>{{ $novela->sinopsis }}</p>
                        @else
                            <p class="text-gray-500 italic">No hay sinopsis disponible para esta novela.</p>
                        @endif
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-2">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center">
                            <i class="fas fa-book-open text-primary-600 mr-2"></i> Capítulos
                        </h2>
                        <a href="{{ route('novelas.capitulos.create', $novela) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 transition-colors">
                            <i class="fas fa-plus mr-1.5"></i> Nuevo capítulo
                        </a>
                    </div>
                    
                    @if($novela->capitulos()->count() > 0)
                        <div class="space-y-2">
                            @foreach($novela->capitulos()->orderBy('numero_capitulo', 'asc')->get() as $capitulo)
                                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 hover:bg-white hover:shadow-sm transition-all">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-full bg-primary-100 text-primary-700 mr-3 border border-primary-200">
                                                <span class="font-bold">{{ $capitulo->numero_capitulo }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ route('novelas.capitulos.show', [$novela, $capitulo]) }}" class="font-medium text-gray-800 hover:text-primary-600 transition-colors">
                                                    {{ $capitulo->titulo }}
                                                </a>
                                                <div class="flex text-xs text-gray-500 mt-1">
                                                    <div class="flex items-center mr-3">
                                                        <i class="fas fa-eye text-primary-500 mr-1"></i> {{ number_format($capitulo->visitas) }}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i class="fas fa-calendar-alt text-primary-500 mr-1"></i> {{ $capitulo->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <a href="{{ route('novelas.capitulos.edit', [$novela, $capitulo]) }}" class="text-gray-500 hover:text-yellow-600 mr-3 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('novelas.capitulos.destroy', [$novela, $capitulo]) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este capítulo?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-600 transition-colors">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-10 text-center bg-gray-50 rounded-lg border border-gray-200">
                            <div class="text-gray-400 mb-3">
                                <i class="fas fa-book text-4xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-500 mb-2">No hay capítulos aún</h3>
                            <p class="text-gray-500 mb-4">¡Comienza a escribir el primer capítulo de tu novela!</p>
                            <a href="{{ route('novelas.capitulos.create', $novela) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i> Crear primer capítulo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-md relative z-10">
            <div class="bg-red-100 py-4 px-6 border-b border-red-200">
                <h3 class="text-lg font-medium text-red-700">Confirmar eliminación</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-4">¿Estás seguro de eliminar esta novela? Esta acción no se puede deshacer y eliminará todos los capítulos asociados.</p>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="hideDeleteModal()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                        Cancelar
                    </button>
                    <button type="button" onclick="deleteNovela()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash-alt mr-2"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" action="{{ route('novelas.destroy', $novela) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function showDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        
        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
        function deleteNovela() {
            document.getElementById('deleteForm').submit();
        }
    </script>
@endsection
