<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Perfil de Administrador') }}
                    </h2>
                    <p class="text-gray-600">Gestiona tu información personal y configuración</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card fade-in">
                <div class="card-header">
                    <h3 class="card-title">Información del Perfil</h3>
                    <p class="card-subtitle">Actualiza tu información personal y de contacto</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header">
                    <h3 class="card-title">Seguridad</h3>
                    <p class="card-subtitle">Actualiza tu contraseña para mantener tu cuenta segura</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header">
                    <h3 class="card-title text-red-600">Zona de Peligro</h3>
                    <p class="card-subtitle">Elimina permanentemente tu cuenta</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
