@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <a href="{{ route('profile.show') }}" class="text-indigo-600 hover:text-indigo-800 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Volver a mi perfil
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Cabecera -->
        <div class="bg-indigo-700 px-6 py-6">
            <h1 class="text-2xl font-bold text-white">Editar Perfil</h1>
            <p class="text-indigo-100 mt-2">Actualiza tu información personal y preferencias de cuenta</p>
        </div>

        <!-- Contenido -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Información del perfil -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                        <h2 class="font-semibold text-lg text-gray-800">Información Personal</h2>
                        <p class="text-sm text-gray-600">Actualiza tu nombre y correo electrónico</p>
                    </div>
                    <div class="p-5">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Cambiar contraseña -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                        <h2 class="font-semibold text-lg text-gray-800">Contraseña</h2>
                        <p class="text-sm text-gray-600">Actualiza tu contraseña de acceso</p>
                    </div>
                    <div class="p-5">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Eliminar cuenta -->
            <div class="mt-8 bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-red-50 px-4 py-3 border-b border-red-100">
                    <h2 class="font-semibold text-lg text-red-800">Zona de peligro</h2>
                    <p class="text-sm text-red-600">Acciones irreversibles para tu cuenta</p>
                </div>
                <div class="p-5">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
