@extends('mecanico.layout')

@section('title', 'Orden #' . $orden->id . ' - Panel de Mecánicos')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <!-- Header con navegación -->
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <div>
                        <a href="{{ route('mecanico.dashboard') }}" class="text-gray-400 hover:text-gray-500">
                            <svg class="flex-shrink-0 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span class="sr-only">Dashboard</span>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('mecanico.dashboard') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Mis Órdenes</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-4 text-sm font-medium text-gray-500">Orden #{{ $orden->id }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Orden de Servicio #{{ $orden->id }}</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Cliente: {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}
                </p>
            </div>
            
            <!-- Selector de estado -->
            <div class="flex items-center space-x-4">
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado:</label>
                <select id="estado" onchange="actualizarEstado({{ $orden->id }}, this.value)" 
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="recibido" {{ $orden->estado == 'recibido' ? 'selected' : '' }}>Recibido</option>
                    <option value="en_proceso" {{ $orden->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="finalizado" {{ $orden->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Información principal -->
        <div class="lg:col-span-2">
            <!-- Información del vehículo -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Información del Vehículo</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Marca</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->vehiculo->marca }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Modelo</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->vehiculo->modelo }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Año</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->vehiculo->año }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Matrícula</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->vehiculo->matricula }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Combustible</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->vehiculo->combustible }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kilometraje</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ number_format($orden->vehiculo->kilometraje) }} km</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Diagnóstico y descripción -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Diagnóstico y Problema</h3>
                    
                    @if($orden->diagnostico)
                        <div class="mb-4">
                            <dt class="text-sm font-medium text-gray-500">Diagnóstico</dt>
                            <dd class="mt-1 text-sm text-gray-900 bg-blue-50 p-3 rounded">{{ $orden->diagnostico }}</dd>
                        </div>
                    @endif

                    @if($orden->descripcion_problema)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Descripción del Problema</dt>
                            <dd class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded">{{ $orden->descripcion_problema }}</dd>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Servicios a realizar -->
            @if($orden->servicios && $orden->servicios->count() > 0)
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Servicios a Realizar</h3>
                        <div class="space-y-3">
                            @foreach($orden->servicios as $servicio)
                                <div class="flex justify-between items-center p-3 bg-blue-50 rounded">
                                    <span class="text-sm font-medium text-gray-900">{{ $servicio->nombre }}</span>
                                    <span class="text-sm text-gray-600">${{ number_format($servicio->precio, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Piezas necesarias -->
            @if($orden->piezas && $orden->piezas->count() > 0)
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Piezas y Repuestos</h3>
                        <div class="space-y-3">
                            @foreach($orden->piezas as $pieza)
                                <div class="flex justify-between items-center p-3 bg-green-50 rounded">
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">{{ $pieza->nombre }}</span>
                                        <span class="text-xs text-gray-500 ml-2">(Cantidad: {{ $pieza->pivot->cantidad }})</span>
                                    </div>
                                    <span class="text-sm text-gray-600">${{ number_format($pieza->precio * $pieza->pivot->cantidad, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Panel lateral -->
        <div class="lg:col-span-1">
            <!-- Información del cliente -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Información del Cliente</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->cliente->telefono }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->cliente->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $orden->cliente->direccion }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Resumen de costos -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Resumen de Costos</h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Costo Total</dt>
                            <dd class="text-lg font-bold text-green-600">${{ number_format($orden->costo_total, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Estado de Pago</dt>
                            <dd class="text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $orden->pagado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $orden->pagado ? 'Pagado' : 'Pendiente' }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Fecha de Creación</dt>
                            <dd class="text-sm text-gray-900">{{ $orden->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function actualizarEstado(ordenId, nuevoEstado) {
    fetch(`/mecanico/orden/${ordenId}/estado`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            estado: nuevoEstado
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar mensaje de éxito
            const mensaje = document.createElement('div');
            mensaje.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50';
            mensaje.textContent = 'Estado actualizado correctamente';
            document.body.appendChild(mensaje);
            
            // Remover mensaje después de 3 segundos
            setTimeout(() => {
                document.body.removeChild(mensaje);
            }, 3000);
        } else {
            alert('Error al actualizar el estado');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar el estado');
    });
}
</script>
@endpush
@endsection
