    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la Orden de Servicio') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Orden de Servicio #{{ $ordenServicio->id }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Cliente:</p>
                                <p class="mt-1 text-gray-900">{{ $ordenServicio->cliente->nombre }} {{ $ordenServicio->cliente->apellido }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Vehículo:</p>
                                <p class="mt-1 text-gray-900">{{ $ordenServicio->vehiculo->marca }} {{ $ordenServicio->vehiculo->modelo }} ({{ $ordenServicio->vehiculo->matricula }})</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Mecánico Asignado:</p>
                                <p class="mt-1 text-gray-900">{{ $ordenServicio->mecanico->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Estado:</p>
                                <p class="mt-1 text-gray-900">{{ ucfirst(str_replace('_', ' ', $ordenServicio->estado)) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Fecha de Recepción:</p>
                                <p class="mt-1 text-gray-900">{{ $ordenServicio->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Última Actualización:</p>
                                <p class="mt-1 text-gray-900">{{ $ordenServicio->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Costo Total:</p>
                                <p class="mt-1 text-gray-900">${{ number_format($ordenServicio->costo_total, 2) }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700">Descripción del Problema:</p>
                            <p class="mt-1 text-gray-900">{{ $ordenServicio->descripcion_problema }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700">Diagnóstico:</p>
                            <p class="mt-1 text-gray-900">{{ $ordenServicio->diagnostico ?? 'No especificado' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700">Servicios a Realizar:</p>
                            <p class="mt-1 text-gray-900">{{ $ordenServicio->servicios_realizar ?? 'No especificado' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700">Repuestos Necesarios:</p>
                            <p class="mt-1 text-gray-900">{{ $ordenServicio->repuestos_necesarios ?? 'No especificado' }}</p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('ordenes-servicio.edit', $ordenServicio->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 mr-3">Editar</a>
                            <form action="{{ route('ordenes-servicio.destroy', $ordenServicio->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta orden?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Eliminar</button>
                            </form>
                            <a href="{{ route('ordenes-servicio.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Volver a la Lista</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>