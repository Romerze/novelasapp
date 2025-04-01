@extends('layouts.app')

@section('title', 'Capítulos de ' . $novela->titulo)

@section('content')
    <div class="mb-8">
        <a href="{{ route('novelas.show', $novela) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Volver a la novela
        </a>
    </div>
    
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center">
        <div class="mb-4 md:mb-0">
            <div class="flex items-center mb-2">
                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-4">
                    <i class="fas fa-book-open"></i>
                </div>
                <h1 class="text-2xl font-serif font-bold text-gray-800">Capítulos de "{{ $novela->titulo }}"</h1>
            </div>
            <p class="text-gray-600">Administra todos los capítulos de tu novela en un solo lugar</p>
        </div>
        <a href="{{ route('novelas.capitulos.create', $novela) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
            <i class="fas fa-plus mr-2"></i> Nuevo Capítulo
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        @if($capitulos->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nº</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visitas</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($capitulos as $capitulo)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="py-3 px-4">
                                    <span class="font-medium text-gray-700 bg-gray-100 py-1 px-3 rounded-full text-sm">{{ $capitulo->numero_capitulo }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('novelas.capitulos.show', [$novela, $capitulo]) }}" class="font-medium text-primary-600 hover:text-primary-700">
                                        {{ $capitulo->titulo }}
                                    </a>
                                </td>
                                <td class="py-3 px-4">
                                    @if($capitulo->publicado)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-700">
                                            <i class="fas fa-check-circle mr-1"></i> Publicado
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-100 text-warning-700">
                                            <i class="fas fa-clock mr-1"></i> Borrador
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center text-gray-600 text-sm">
                                        <i class="fas fa-eye text-info-600 mr-1"></i>
                                        {{ number_format($capitulo->visitas) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-600 text-sm">
                                    <span title="{{ $capitulo->created_at }}">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $capitulo->created_at->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('novelas.capitulos.show', [$novela, $capitulo]) }}" 
                                           class="text-gray-500 hover:text-primary-600 transition-colors duration-200 w-8 h-8 rounded-full flex items-center justify-center hover:bg-primary-50" 
                                           title="Ver capítulo">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('novelas.capitulos.edit', [$novela, $capitulo]) }}" 
                                           class="text-gray-500 hover:text-warning-600 transition-colors duration-200 w-8 h-8 rounded-full flex items-center justify-center hover:bg-warning-50" 
                                           title="Editar capítulo">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="text-gray-500 hover:text-danger-600 transition-colors duration-200 w-8 h-8 rounded-full flex items-center justify-center hover:bg-danger-50"
                                                title="Eliminar capítulo"
                                                onclick="confirmarEliminacion('{{ route('novelas.capitulos.destroy', [$novela, $capitulo]) }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $capitulos->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <div class="w-20 h-20 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mx-auto mb-6">
                    <i class="fas fa-book-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-800 mb-2">No hay capítulos aún</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">Esta novela todavía no tiene capítulos. Comienza a escribir el primer capítulo de tu historia.</p>
                <a href="{{ route('novelas.capitulos.create', $novela) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                    <i class="fas fa-plus mr-2"></i> Crear primer capítulo
                </a>
            </div>
        @endif
    </div>

    <div class="mt-8 bg-secondary-100 border-l-4 border-secondary-600 p-4 rounded-r-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-lightbulb text-secondary-600"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-gray-800">Consejos para organizar tus capítulos</h3>
                <div class="mt-2 text-sm text-gray-600">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Mantén un ritmo constante en la publicación de nuevos capítulos</li>
                        <li>Utiliza números de capítulo consecutivos para mantener el orden</li>
                        <li>Revisa la consistencia entre capítulos para evitar contradicciones</li>
                        <li>Considera guardar como borrador los capítulos que necesiten revisión adicional</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación (usando SweetAlert2) -->
    <form id="form-eliminar" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('scripts')
<script>
    function confirmarEliminacion(url) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Este capítulo será eliminado permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Color danger
            cancelButtonColor: '#6366f1', // Color primary
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('form-eliminar');
                form.action = url;
                form.submit();
            }
        });
    }
</script>
@endsection
