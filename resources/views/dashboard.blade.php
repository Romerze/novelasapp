@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Dashboard') }}
                    </h2>
                    
                    <p class="mb-4">{{ __("¡Bienvenido a tu panel de control!") }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="bg-indigo-50 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-medium text-indigo-700 mb-3">Mis Novelas</h3>
                            <p class="text-gray-600 mb-4">Administra tus novelas, crea nuevas o edita las existentes.</p>
                            <a href="{{ route('novelas.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ver mis novelas
                            </a>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-medium text-green-700 mb-3">Nueva Novela</h3>
                            <p class="text-gray-600 mb-4">¿Tienes una nueva historia? Comienza a escribirla ahora.</p>
                            <a href="{{ route('novelas.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Crear nueva novela
                            </a>
                        </div>
                        
                        <div class="bg-purple-50 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-medium text-purple-700 mb-3">Géneros</h3>
                            <p class="text-gray-600 mb-4">Explora y administra los géneros literarios.</p>
                            <a href="{{ route('generos.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Administrar géneros
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-700">Documentación del Sistema</h3>
                            <a href="{{ route('documentacion.pdf') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Descargar PDF de Documentación
                            </a>
                        </div>
                        <p class="text-gray-600 mt-2">Descarga la documentación completa técnica y funcional de NovelasApp.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
