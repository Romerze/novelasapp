@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Panel de Administración</h1>
        <p class="text-gray-600 mb-6">Bienvenido al panel de administración del sistema</p>
        
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="bg-blue-100 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-blue-200 p-3 mr-4">
                        <i class="fas fa-users text-blue-700 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-blue-700 text-sm font-medium">Usuarios</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-indigo-100 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-indigo-200 p-3 mr-4">
                        <i class="fas fa-book text-indigo-700 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-indigo-700 text-sm font-medium">Novelas</p>
                        <p class="text-2xl font-bold text-indigo-900">{{ $totalNovelas }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-purple-100 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-purple-200 p-3 mr-4">
                        <i class="fas fa-file-alt text-purple-700 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-purple-700 text-sm font-medium">Capítulos</p>
                        <p class="text-2xl font-bold text-purple-900">{{ $totalCapitulos }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-pink-100 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-pink-200 p-3 mr-4">
                        <i class="fas fa-tags text-pink-700 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-pink-700 text-sm font-medium">Géneros</p>
                        <p class="text-2xl font-bold text-pink-900">{{ $totalGeneros }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-green-100 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-green-200 p-3 mr-4">
                        <i class="fas fa-eye text-green-700 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-green-700 text-sm font-medium">Visitas</p>
                        <p class="text-2xl font-bold text-green-900">{{ number_format($totalVisitasSistema) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Acciones Administrativas</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('generos.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white py-2 px-6 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Nuevo Género
                </a>
                <a href="{{ route('generos.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-6 rounded-lg flex items-center">
                    <i class="fas fa-tags mr-2"></i> Administrar Géneros
                </a>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg flex items-center">
                    <i class="fas fa-users mr-2"></i> Administrar Usuarios
                </a>
            </div>
        </div>
    </div>
    
    <!-- Novelas Populares -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Novelas Más Populares</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left">Portada</th>
                        <th class="py-3 px-4 text-left">Título</th>
                        <th class="py-3 px-4 text-left">Autor</th>
                        <th class="py-3 px-4 text-left">Capítulos</th>
                        <th class="py-3 px-4 text-left">Visitas</th>
                        <th class="py-3 px-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($novelasPopulares as $novela)
                        <tr>
                            <td class="py-3 px-4">
                                <img src="{{ $novela->imagen_portada ? asset('storage/' . $novela->imagen_portada) : asset('images/default-cover.jpg') }}" 
                                    alt="{{ $novela->titulo }}" class="w-16 h-20 object-cover rounded">
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-medium">{{ $novela->titulo }}</span>
                            </td>
                            <td class="py-3 px-4">{{ $novela->user->name }}</td>
                            <td class="py-3 px-4">{{ $novela->capitulos()->count() }}</td>
                            <td class="py-3 px-4">{{ number_format($novela->visitas) }}</td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('novelas.show', $novela) }}" class="text-blue-600 hover:text-blue-800" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-gray-500 text-center">No hay novelas disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Actividad Reciente -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Estadísticas del Sistema</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-3">Distribución de Géneros</h3>
                <div class="h-64 flex items-center justify-center">
                    <p class="text-gray-500 text-center">
                        Aquí se mostraría un gráfico de distribución de géneros.<br>
                        <span class="text-xs">Implemente visualizaciones con Chart.js o una librería similar.</span>
                    </p>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-3">Crecimiento Mensual</h3>
                <div class="h-64 flex items-center justify-center">
                    <p class="text-gray-500 text-center">
                        Aquí se mostraría un gráfico de crecimiento mensual.<br>
                        <span class="text-xs">Implemente visualizaciones con Chart.js o una librería similar.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
