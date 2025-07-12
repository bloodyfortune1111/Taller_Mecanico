<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Encabezado -->
                    <div class="mb-6 pb-4 border-b">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $servicio->nombre }}</h3>
                                <p class="text-sm text-gray-600 mt-1">ID: {{ $servicio->id }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('servicios.edit', $servicio) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Editar
                                </a>
                                <a href="{{ route('servicios.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 transition ease-in-out duration-150">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Servicio -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Información Básica</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Categoría:</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $servicio->categoria }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Estado:</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $servicio->activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $servicio->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Detalles del Servicio</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Precio Base:</dt>
                                    <dd class="text-lg font-semibold text-green-600">${{ number_format($servicio->precio_base, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tiempo Estimado:</dt>
                                    <dd class="text-sm text-gray-900">
                                        @if($servicio->tiempo_estimado)
                                            {{ $servicio->tiempo_estimado }} minutos
                                            @if($servicio->tiempo_estimado >= 60)
                                                ({{ floor($servicio->tiempo_estimado / 60) }}h {{ $servicio->tiempo_estimado % 60 }}m)
                                            @endif
                                        @else
                                            No especificado
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($servicio->descripcion)
                    <div class="mb-8">
                        <h4 class="font-medium text-gray-900 mb-3">Descripción</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $servicio->descripcion }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Información de Auditoría -->
                    <div class="border-t pt-6">
                        <h4 class="font-medium text-gray-900 mb-3">Información de Auditoría</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Creado:</dt>
                                <dd class="text-sm text-gray-900">{{ $servicio->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Última Actualización:</dt>
                                <dd class="text-sm text-gray-900">{{ $servicio->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas (si hay órdenes de servicio relacionadas) -->
                    @if($servicio->ordenesServicio && $servicio->ordenesServicio->count() > 0)
                    <div class="border-t pt-6 mt-6">
                        <h4 class="font-medium text-gray-900 mb-3">Estadísticas de Uso</h4>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-800">
                                Este servicio ha sido utilizado en <strong>{{ $servicio->ordenesServicio->count() }}</strong> órdenes de servicio.
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
