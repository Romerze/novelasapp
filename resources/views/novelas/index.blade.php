@extends('layouts.app')

@section('title', 'Mis Novelas')

@section('content')
    <!-- Encabezado de página -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-5">
        <h1 class="text-2xl font-serif font-bold text-gray-800 mb-2 sm:mb-0 flex items-center">
            <i class="fas fa-book text-primary-600 mr-2"></i>Mis Novelas
        </h1>
        <a href="{{ route('novelas.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
            <i class="fas fa-plus mr-2"></i> Nueva Novela
        </a>
    </div>

    @if($novelas->count() > 0)
        <div class="grid grid-cols-1 gap-4 mb-5">
            @foreach($novelas as $novela)
                <div class="bg-white rounded-lg shadow border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-[140px] flex-shrink-0">
                            <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                alt="{{ $novela->titulo }}" class="w-full h-40 md:h-full object-cover">
                        </div>
                        <div class="p-4 md:p-5 flex-grow">
                            <div class="flex flex-col md:flex-row md:items-start justify-between">
                                <div class="flex-1">
                                    <h2 class="text-lg font-medium text-gray-800 mb-1.5">{{ $novela->titulo }}</h2>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($novela->descripcion, 150) }}</p>
                                    
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700">
                                            <i class="fas fa-book-open mr-1"></i> {{ $novela->capitulos()->count() }} capítulos
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-info-100 text-info-700">
                                            <i class="fas fa-eye mr-1"></i> {{ $novela->visitas ?? 0 }} visitas
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $novela->publicada ? 'bg-success-100 text-success-700' : 'bg-warning-100 text-warning-700' }}">
                                            <i class="fas {{ $novela->publicada ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i> 
                                            {{ $novela->publicada ? 'Publicada' : 'Borrador' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2 md:mt-0 md:ml-4 text-sm text-gray-500 flex flex-col space-y-1 md:text-right">
                                    <span class="flex items-center md:justify-end">
                                        <i class="fas fa-tag mr-2 text-gray-400"></i> 
                                        {{ $novela->genero ? $novela->genero->nombre : 'Sin género' }}
                                    </span>
                                    <span class="flex items-center md:justify-end">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i> 
                                        {{ $novela->updated_at->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex flex-wrap items-center gap-2">
                                <a href="{{ route('novelas.show', $novela) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-300">
                                    <i class="fas fa-eye text-primary-600 mr-1.5"></i> Ver
                                </a>
                                <a href="{{ route('novelas.edit', $novela) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-warning-300">
                                    <i class="fas fa-edit text-warning-600 mr-1.5"></i> Editar
                                </a>
                                <a href="{{ route('novelas.capitulos.index', $novela) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-secondary-300">
                                    <i class="fas fa-list-ul text-secondary-600 mr-1.5"></i> Capítulos
                                </a>
                                <a href="{{ route('novelas.capitulos.create', $novela) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-success-300">
                                    <i class="fas fa-plus text-success-600 mr-1.5"></i> Nuevo capítulo
                                </a>
                                
                                <!-- Botón para eliminar novela -->
                                <button onclick="eliminarNovela({{ $novela->id }}, '{{ $novela->titulo }}')" 
                                        class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-danger-300">
                                    <i class="fas fa-trash-alt text-danger-600 mr-1.5"></i> Eliminar
                                </button>
                                <form id="form-eliminar-{{ $novela->id }}" action="{{ route('novelas.destroy', $novela) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-5">
            {{ $novelas->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center border border-gray-100">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                <i class="fas fa-book-open text-2xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-800 mb-2">No has creado ninguna novela aún</h3>
            <p class="text-gray-600 mb-4 max-w-md mx-auto">¡Es hora de empezar a escribir y compartir tus historias con el mundo!</p>
            
            <a href="{{ route('novelas.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                <i class="fas fa-plus mr-2"></i> Crear Mi Primera Novela
            </a>
        </div>
    @endif

    <!-- Scripts para SweetAlert2 -->
    <script>
        function eliminarNovela(id, titulo) {
            Swal.fire({
                title: '¿Eliminar esta novela?',
                html: `¿Estás seguro de que deseas eliminar la novela <strong>${titulo}</strong>?<br>Esta acción no se puede deshacer.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', // Color danger
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-eliminar-${id}`).submit();
                }
            });
        }
    </script>
@endsection
