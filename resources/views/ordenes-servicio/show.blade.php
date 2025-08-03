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
                            <p class="text-sm text-gray-500">Estado de Pago:</p>
                            <p class="text-lg font-medium text-gray-900">
                                <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full
                                    @if($ordenServicio->pagado ?? false) bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ($ordenServicio->pagado ?? false) ? 'Pagado' : 'Pendiente' }}
                                </span>
                            </p>
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
                        @if($ordenServicio->servicios && $ordenServicio->servicios->count() > 0)
                            <div class="mt-2 space-y-2">
                                @foreach($ordenServicio->servicios as $servicio)
                                    <div class="flex justify-between items-center p-2 bg-blue-50 rounded border">
                                        <span class="font-medium">{{ $servicio->nombre }}</span>
                                        <div class="text-right">
                                            <span class="text-green-600 font-bold">${{ number_format($servicio->precio, 2) }}</span>
                                            @if($servicio->descripcion)
                                                <p class="text-xs text-gray-600">{{ $servicio->descripcion }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <div class="flex justify-end pt-2 border-t border-blue-200">
                                    <span class="font-bold text-blue-800">
                                        Subtotal Servicios: ${{ number_format($ordenServicio->servicios->sum('precio'), 2) }}
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if($ordenServicio->servicios_realizar)
                            <div class="mt-3 p-2 bg-gray-50 rounded">
                                <p class="text-sm text-gray-600 font-medium">Descripción adicional:</p>
                                <p class="text-gray-900 text-base mt-1">{{ $ordenServicio->servicios_realizar }}</p>
                            </div>
                        @endif
                        @if((!$ordenServicio->servicios || $ordenServicio->servicios->count() == 0) && !$ordenServicio->servicios_realizar)
                            <p class="text-gray-900 text-base mt-1">N/A</p>
                        @endif
                    </div>

                    <div class="mt-4 border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-500">Piezas y Repuestos:</p>
                        @if($ordenServicio->piezas && $ordenServicio->piezas->count() > 0)
                            <div class="mt-2 space-y-2">
                                @foreach($ordenServicio->piezas as $pieza)
                                    <div class="flex justify-between items-center p-2 bg-green-50 rounded border">
                                        <div>
                                            <span class="font-medium">{{ $pieza->nombre }}</span>
                                            <span class="text-gray-600">(x{{ $pieza->pivot->cantidad }})</span>
                                            @if($pieza->numero_parte)
                                                <p class="text-xs text-gray-600">Parte: {{ $pieza->numero_parte }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <span class="text-green-600 font-bold">
                                                ${{ number_format($pieza->precio * $pieza->pivot->cantidad, 2) }}
                                            </span>
                                            <p class="text-xs text-gray-600">
                                                ${{ number_format($pieza->precio, 2) }} c/u
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="flex justify-end pt-2 border-t border-green-200">
                                    <span class="font-bold text-green-800">
                                        Subtotal Piezas: ${{ number_format($ordenServicio->piezas->sum(function($pieza) { return $pieza->precio * $pieza->pivot->cantidad; }), 2) }}
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if($ordenServicio->repuestos_necesarios)
                            <div class="mt-3 p-2 bg-gray-50 rounded">
                                <p class="text-sm text-gray-600 font-medium">Descripción adicional:</p>
                                <p class="text-gray-900 text-base mt-1">{{ $ordenServicio->repuestos_necesarios }}</p>
                            </div>
                        @endif
                        @if((!$ordenServicio->piezas || $ordenServicio->piezas->count() == 0) && !$ordenServicio->repuestos_necesarios)
                            <p class="text-gray-900 text-base mt-1">N/A</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        @if($ordenServicio->pagado)
                            <a href="{{ route('ordenes-servicio.recibo', ['orden_servicio' => $ordenServicio->id]) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 mr-2">
                                <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Descargar Recibo
                            </a>
                        @else
                            <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded cursor-not-allowed mr-2" title="El recibo solo está disponible para órdenes pagadas">
                                <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Recibo Bloqueado
                            </button>
                        @endif
                        <a href="{{ route('ordenes-servicio.edit', ['orden_servicio' => $ordenServicio->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-2">
                            Editar Orden
                        </a>
                        <form action="{{ route('ordenes-servicio.destroy', ['orden_servicio' => $ordenServicio->id]) }}" method="POST" class="inline">
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