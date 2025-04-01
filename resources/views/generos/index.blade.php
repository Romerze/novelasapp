@extends('layouts.app')

@section('title', 'Géneros Literarios')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <h1 class="page-heading flex items-center">
            <i class="fas fa-tags text-primary-600 mr-3"></i>Géneros Literarios
        </h1>
        @can('create', App\Models\Genero::class)
            <a href="{{ route('generos.create') }}" class="mt-4 sm:mt-0 bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors shadow flex items-center">
                <i class="fas fa-plus mr-2"></i> Nuevo Género
            </a>
        @endcan
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($generos as $genero)
            <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow border border-gray-100 hover:border-primary-300 overflow-hidden">
                <div class="p-5">
                    <h2 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <i class="fas fa-tag text-primary-600 mr-2"></i>
                        {{ $genero->nombre }}
                    </h2>
                    
                    @if($genero->descripcion)
                        <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($genero->descripcion, 100) }}</p>
                    @endif
                    
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="bg-primary-100 text-primary-700 py-1 px-3 rounded-full flex items-center border border-primary-200">
                            <i class="fas fa-book mr-1"></i> {{ $genero->novelas()->count() }} novelas
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                        <a href="{{ route('generos.show', $genero) }}" class="text-primary-600 hover:text-primary-800 transition-colors flex items-center text-sm font-medium">
                            Ver novelas <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        
                        @can('update', $genero)
                            <div class="flex gap-2">
                                <a href="{{ route('generos.edit', $genero) }}" 
                                   class="text-gray-600 hover:text-warning-600 transition-colors p-1.5 rounded-full hover:bg-warning-50"
                                   title="Editar género">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        onclick="confirmarEliminacion({{ $genero->id }}, '{{ $genero->nombre }}')" 
                                        class="text-gray-600 hover:text-danger-600 transition-colors p-1.5 rounded-full hover:bg-danger-50"
                                        title="Eliminar género">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <form id="form-eliminar-{{ $genero->id }}" action="{{ route('generos.destroy', $genero) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                    <i class="fas fa-tags text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay géneros disponibles</h3>
                <p class="text-gray-500 mb-6">Aún no se ha creado ningún género literario</p>
                
                @can('create', App\Models\Genero::class)
                    <a href="{{ route('generos.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-colors shadow inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i> Crear Primer Género
                    </a>
                @endcan
            </div>
        @endforelse
    </div>
    
    @if($generos->hasPages())
        <div class="mt-6">
            {{ $generos->links() }}
        </div>
    @endif
@endsection

@section('scripts')
<script>
    function confirmarEliminacion(generoId, generoNombre) {
        Swal.fire({
            title: 'Eliminar género',
            html: `¿Estás seguro de eliminar <strong>"${generoNombre}"</strong>?<br><span class="text-gray-500">Esta acción no se puede deshacer.</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--color-danger-600').trim() || '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`form-eliminar-${generoId}`).submit();
            }
        });
    }
</script>
@endsection
