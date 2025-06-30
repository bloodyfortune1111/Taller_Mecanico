<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de Orden de Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detalles de Orden de Servicio #{{ $ordenServicio->id }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Cliente:</p>
                            <p class="text-lg font-medium text-gray-900">
                                @if($ordenServicio->cliente)
                                    <a href="{{ route('clientes.show', $ordenServicio->cliente->id) }}" class="text-blue-600 hover:underline">
                                        {{ $ordenServicio->cliente->nombre }} {{ $ordenServicio->cliente->apellido }}
                                    </a>
                                    ({{ $ordenServicio->cliente->email }})
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Vehículo:</p>
                            <p class="text-lg font-medium text-gray-900">
                                @if($ordenServicio->vehiculo)
                                    <a href="{{ route('vehiculos.show', $ordenServicio->vehiculo->id) }}" class="text-blue-600 hover:underline">
                                        {{ $ordenServicio->vehiculo->marca }} {{ $ordenServicio->vehiculo->modelo }} ({{ $ordenServicio->vehiculo->matricula }})
                                    </a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Mecánico Asignado:</p>
                            <p class="text-lg font-medium text-gray-900">
                                @if($ordenServicio->mecanico)
                                    {{ $ordenServicio->mecanico->name }}
                                @else
                                    Sin Asignar
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Estado:</p>
                            <p class="text-lg font-medium text-gray-900">
                                <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full
                                    @if($ordenServicio->estado == 'recibido') bg-yellow-100 text-yellow-800
                                    @elseif($ordenServicio->estado == 'en_proceso') bg-blue-100 text-blue-800
                                    @elseif($ordenServicio->estado == 'finalizado') bg-green-100 text-green-800
                                    @elseif($ordenServicio->estado == 'entregado') bg-purple-100 text-purple-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $ordenServicio->estado)) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Costo Total:</p>
                            <p class="text-lg font-medium text-gray-900">${{ number_format($ordenServicio->costo_total, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Fecha de Creación:</p>
                            <p class="text-lg font-medium text-gray-900">{{ optional($ordenServicio->created_at)->format('d/m/Y H:i') ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Última Actualización:</p>
                            <p class="text-lg font-medium text-gray-900">{{ optional($ordenServicio->updated_at)->format('d/m/Y H:i') ?: 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-500">Diagnóstico:</p>
                        <p class="text-gray-900 text-base mt-1">{{ $ordenServicio->diagnostico ?? 'N/A' }}</p>
                    </div>

                    <div class="mt-4 border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-500">Servicios a Realizar:</p>
                        <p class="text-gray-900 text-base mt-1">{{ $ordenServicio->servicios_realizar ?? 'N/A' }}</p>
                    </div>

                    <div class="mt-4 border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-500">Repuestos Necesarios:</p>
                        <p class="text-gray-900 text-base mt-1">{{ $ordenServicio->repuestos_necesarios ?? 'N/A' }}</p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('ordenes-servicio.edit', $ordenServicio) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-2">
                            Editar Orden
                        </a>
                        <form action="{{ route('ordenes-servicio.destroy', $ordenServicio->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('¿Estás seguro de eliminar esta orden de servicio?')">
                                Eliminar Orden
                            </button>
                        </form>
                        <a href="{{ route('ordenes-servicio.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 ml-2">
                            Volver a la Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>