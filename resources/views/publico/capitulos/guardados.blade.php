@extends('layouts.app')

@section('title', 'Mis Capítulos Guardados')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Mis Capítulos Guardados</h1>
            <p class="mt-2 text-gray-600">Los capítulos que has guardado para leer más tarde</p>
        </div>
        
        @if($capitulos->count() > 0)
        <div class="mt-4 md:mt-0">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Buscar capítulo..." class="w-full md:w-64 px-4 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>
        @endif
    </div>

    @if($capitulos->count() > 0)
        <!-- Filtros -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex flex-wrap gap-3">
            <button class="filter-btn active px-3 py-1.5 rounded text-sm font-medium bg-indigo-100 text-indigo-800" data-filter="all">
                Todos <span class="ml-1 bg-indigo-200 text-indigo-800 px-1.5 py-0.5 rounded-full text-xs">{{ $capitulos->count() }}</span>
            </button>
            <button class="filter-btn px-3 py-1.5 rounded text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="recent">
                Recientes
            </button>
            <!-- Filtro por género si está disponible -->
            @php
                $generos = $capitulos->pluck('novela.generos')->flatten()->unique('id');
            @endphp
            @foreach($generos as $genero)
                @if($genero)
                <button class="filter-btn px-3 py-1.5 rounded text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="genero-{{ $genero->id }}">
                    {{ $genero->nombre }}
                </button>
                @endif
            @endforeach
        </div>

        <!-- Lista de capítulos -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <ul class="divide-y divide-gray-200" id="capitulos-list">
                @foreach($capitulos as $capitulo)
                <li class="hover:bg-gray-50 capitulo-item {{ $capitulo->created_at->isAfter(now()->subDays(7)) ? 'recent' : '' }}" 
                    data-title="{{ strtolower($capitulo->titulo) }}"
                    data-generos="{{ $capitulo->novela->generos->pluck('id')->implode(',') }}">
                    <div class="px-6 py-5">
                        <div class="flex flex-col sm:flex-row sm:justify-between gap-4">
                            <div>
                                <div class="flex items-center">
                                    <a href="{{ route('novelas.publico.show', $capitulo->novela) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                        {{ $capitulo->novela->titulo }}
                                    </a>
                                    <span class="mx-2 text-gray-500">&bull;</span>
                                    <span class="text-sm text-gray-500">Capítulo {{ $capitulo->numero_capitulo }}</span>
                                    
                                    <!-- Indicador de nuevo -->
                                    @if($capitulo->created_at->isAfter(now()->subDays(7)))
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        Nuevo
                                    </span>
                                    @endif
                                </div>
                                
                                <a href="{{ route('capitulos.publico.show', [$capitulo->novela, $capitulo]) }}" class="mt-1 block text-xl font-semibold text-gray-900 hover:text-indigo-600">
                                    {{ $capitulo->titulo }}
                                </a>
                                
                                <div class="mt-2 flex flex-wrap items-center text-sm text-gray-500 gap-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-user mr-1"></i>
                                        <span>{{ $capitulo->novela->user->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        <span>{{ $capitulo->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span>{{ number_format($capitulo->visitas) }} visitas</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-heart mr-1 text-red-500"></i>
                                        <span>{{ $capitulo->usuariosConLike()->count() }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        <span>Guardado {{ $capitulo->pivot->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                
                                <!-- Géneros -->
                                @if($capitulo->novela->generos->count() > 0)
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach($capitulo->novela->generos as $genero)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ $genero->nombre }}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                                
                                <!-- Resumen del contenido -->
                                <div class="mt-3 text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($capitulo->contenido), 150) }}
                                </div>
                            </div>

                            <div class="flex sm:flex-col items-center sm:items-end gap-2 sm:gap-3 mt-4 sm:mt-0">
                                <a href="{{ route('capitulos.publico.show', [$capitulo->novela, $capitulo]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition duration-150">
                                    <i class="fas fa-book-open mr-2"></i>
                                    Leer
                                </a>
                                <form action="{{ route('capitulos.guardar', $capitulo) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn-guardar-capitulo inline-flex items-center px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 text-sm font-medium rounded-md transition duration-150">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Quitar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-6">
            {{ $capitulos->links() }}
        </div>
        
        <!-- Mensaje de "No hay resultados" que se muestra con JavaScript -->
        <div id="no-results" class="hidden mt-6 bg-white p-8 rounded-lg shadow-md text-center">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-search text-4xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No se encontraron resultados</h3>
            <p class="text-gray-600">Intenta con otra búsqueda o quita los filtros aplicados.</p>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg p-10 text-center">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-bookmark text-5xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No tienes capítulos guardados</h3>
            <p class="text-gray-600 mb-6">Empieza a explorar novelas y guarda los capítulos que te interesen para leerlos más tarde.</p>
            <a href="{{ route('inicio') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition duration-150">
                <i class="fas fa-home mr-2"></i>
                Explorar novelas
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Búsqueda en tiempo real
        const searchInput = document.getElementById('searchInput');
        const capitulosList = document.getElementById('capitulos-list');
        const capitulosItems = document.querySelectorAll('.capitulo-item');
        const noResults = document.getElementById('no-results');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                filterItems();
            });
        }
        
        // Filtros
        const filterButtons = document.querySelectorAll('.filter-btn');
        let activeFilter = 'all';
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active', 'bg-indigo-100', 'text-indigo-800'));
                filterButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-700'));
                
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('active', 'bg-indigo-100', 'text-indigo-800');
                
                activeFilter = this.getAttribute('data-filter');
                filterItems();
            });
        });
        
        function filterItems() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
            let visibleCount = 0;
            
            capitulosItems.forEach(item => {
                const title = item.getAttribute('data-title');
                const generos = item.getAttribute('data-generos').split(',');
                let matchesFilter = false;
                
                // Aplicar filtro activo
                if (activeFilter === 'all') {
                    matchesFilter = true;
                } else if (activeFilter === 'recent') {
                    matchesFilter = item.classList.contains('recent');
                } else if (activeFilter.startsWith('genero-')) {
                    const generoId = activeFilter.replace('genero-', '');
                    matchesFilter = generos.includes(generoId);
                }
                
                // Aplicar búsqueda
                const matchesSearch = !searchTerm || title.includes(searchTerm);
                
                // Mostrar/ocultar según los filtros
                if (matchesFilter && matchesSearch) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Mostrar mensaje si no hay resultados
            if (noResults) {
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }
        }
    });
</script>
@endpush
@endsection
