<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('servicios.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-4">
                            <x-input-label for="nombre" :value="__('Nombre del Servicio')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <x-input-label for="descripcion" :value="__('Descripción')" />
                            <textarea id="descripcion" name="descripcion" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Categoria -->
                        <div class="mb-4">
                            <x-input-label for="categoria" :value="__('Categoría')" />
                            <select id="categoria" name="categoria" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Seleccionar categoría</option>
                                <option value="Mantenimiento" {{ old('categoria') == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="Reparación" {{ old('categoria') == 'Reparación' ? 'selected' : '' }}>Reparación</option>
                                <option value="Diagnóstico" {{ old('categoria') == 'Diagnóstico' ? 'selected' : '' }}>Diagnóstico</option>
                                <option value="Instalación" {{ old('categoria') == 'Instalación' ? 'selected' : '' }}>Instalación</option>
                                <option value="Limpieza" {{ old('categoria') == 'Limpieza' ? 'selected' : '' }}>Limpieza</option>
                            </select>
                            <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
                        </div>

                        <!-- Precio Base -->
                        <div class="mb-4">
                            <x-input-label for="precio_base" :value="__('Precio Base ($)')" />
                            <x-text-input id="precio_base" class="block mt-1 w-full" type="number" name="precio_base" :value="old('precio_base')" step="0.01" min="0" required />
                            <x-input-error :messages="$errors->get('precio_base')" class="mt-2" />
                        </div>

                        <!-- Tiempo Estimado -->
                        <div class="mb-4">
                            <x-input-label for="tiempo_estimado" :value="__('Tiempo Estimado (minutos)')" />
                            <x-text-input id="tiempo_estimado" class="block mt-1 w-full" type="number" name="tiempo_estimado" :value="old('tiempo_estimado')" min="0" />
                            <x-input-error :messages="$errors->get('tiempo_estimado')" class="mt-2" />
                        </div>

                        <!-- Activo -->
                        <div class="mb-4">
                            <label for="activo" class="flex items-center">
                                <input id="activo" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="activo" value="1" {{ old('activo') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Servicio activo') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('servicios.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 active:bg-gray-400 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                                {{ __('Cancelar') }}
                            </a>

                            <x-primary-button class="ml-3">
                                {{ __('Crear Servicio') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
