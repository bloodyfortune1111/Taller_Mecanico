<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Servicio: {{ $servicio->nombre }}</h3>
                        <p class="text-sm text-gray-600">Modifica los detalles del servicio ofrecido por el taller.</p>
                    </div>

                    <form action="{{ route('servicios.update', $servicio) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre del Servicio -->
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Servicio</label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $servicio->nombre) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Categoría -->
                            <div>
                                <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                                <select name="categoria" id="categoria" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Seleccione una categoría</option>
                                    <option value="Mantenimiento Preventivo" {{ old('categoria', $servicio->categoria) == 'Mantenimiento Preventivo' ? 'selected' : '' }}>Mantenimiento Preventivo</option>
                                    <option value="Mantenimiento Mayor" {{ old('categoria', $servicio->categoria) == 'Mantenimiento Mayor' ? 'selected' : '' }}>Mantenimiento Mayor</option>
                                    <option value="Reparación" {{ old('categoria', $servicio->categoria) == 'Reparación' ? 'selected' : '' }}>Reparación</option>
                                    <option value="Diagnóstico" {{ old('categoria', $servicio->categoria) == 'Diagnóstico' ? 'selected' : '' }}>Diagnóstico</option>
                                    <option value="Otros" {{ old('categoria', $servicio->categoria) == 'Otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                                @error('categoria')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Precio Base -->
                            <div>
                                <label for="precio_base" class="block text-sm font-medium text-gray-700">Precio Base ($)</label>
                                <input type="number" name="precio_base" id="precio_base" step="0.01" min="0" value="{{ old('precio_base', $servicio->precio_base) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('precio_base')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tiempo Estimado -->
                            <div>
                                <label for="tiempo_estimado" class="block text-sm font-medium text-gray-700">Tiempo Estimado (minutos)</label>
                                <input type="number" name="tiempo_estimado" id="tiempo_estimado" min="0" value="{{ old('tiempo_estimado', $servicio->tiempo_estimado) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('tiempo_estimado')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4" 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado Activo -->
                        <div>
                            <div class="flex items-center">
                                <input type="checkbox" name="activo" id="activo" value="1" {{ old('activo', $servicio->activo) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <label for="activo" class="ml-2 block text-sm text-gray-900">
                                    Servicio activo (disponible para órdenes de servicio)
                                </label>
                            </div>
                            @error('activo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('servicios.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Actualizar Servicio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
