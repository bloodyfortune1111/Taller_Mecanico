<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Órdenes de Servicio') }}
                    </h2>
                    <p class="text-gray-600">Gestiona todas las órdenes de trabajo</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card fade-in">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="card-title">Lista de Órdenes de Servicio</h3>
                            <p class="card-subtitle">Supervisa el progreso de todas las órdenes</p>
                        </div>
                        @php
                            // Determinar la ruta correcta basada en el rol del usuario
                            $createRoute = Auth::user()->role === 'admin' 
                                ? route('ordenes-servicio.create') 
                                : route('recepcionista.ordenes-servicio.create');
                        @endphp
                        <a href="{{ $createRoute }}" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Crear Nueva Orden
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success scale-in">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-error scale-in">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($ordenesServicio->isEmpty())
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay órdenes de servicio registradas</h3>
                            <p class="text-gray-600 mb-6">Comienza creando la primera orden de servicio</p>
                            <a href="{{ $createRoute }}" class="btn btn-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Crear Orden
                            </a>
                        </div>
                    @else
                        <div class="table-container">
                            <table class="table">
                                <thead class="table-header">
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Vehículo</th>
                                        <th>Mecánico</th>
                                        <th>Estado</th>
                                        <th>Pago</th>
                                        <th>Costo Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @foreach ($ordenesServicio as $orden)
                                        <tr>
                                            <td>
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                                        {{ $orden->id }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                        {{ substr($orden->cliente->nombre, 0, 1) }}{{ substr($orden->cliente->apellido, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900">{{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-medium text-gray-900">{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</div>
                                                <div class="text-sm text-gray-600">{{ $orden->vehiculo->matricula }}</div>
                                            </td>
                                            <td>
                                                @if($orden->mecanico)
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                            {{ substr($orden->mecanico->name, 0, 1) }}
                                                        </div>
                                                        <div class="font-medium text-gray-900">{{ $orden->mecanico->name }}</div>
                                                    </div>
                                                @else
                                                    <span class="badge badge-warning">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($orden->estado == 'recibido')
                                                    <span class="badge badge-primary">Recibido</span>
                                                @elseif($orden->estado == 'en_proceso')
                                                    <span class="badge badge-warning">En Proceso</span>
                                                @elseif($orden->estado == 'finalizado')
                                                    <span class="badge badge-success">Finalizado</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ ucfirst(str_replace('_', ' ', $orden->estado)) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($orden->pagado)
                                                    <span class="badge badge-success">Pagado</span>
                                                @else
                                                    <span class="badge badge-danger">Pendiente</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="font-bold text-gray-900">${{ number_format($orden->costo_total, 2) }}</div>
                                            </td>
                                            <td>
                                                @php
                                                    // Determinar las rutas correctas basadas en el rol del usuario
                                                    $showRoute = Auth::user()->role === 'admin' 
                                                        ? route('ordenes-servicio.show', ['orden_servicio' => $orden->id])
                                                        : route('recepcionista.ordenes-servicio.show', ['orden_servicio' => $orden->id]);
                                                    
                                                    $editRoute = Auth::user()->role === 'admin' 
                                                        ? route('ordenes-servicio.edit', ['orden_servicio' => $orden->id])
                                                        : '#'; // Los recepcionistas no pueden editar
                                                    
                                                    $deleteRoute = Auth::user()->role === 'admin' 
                                                        ? route('ordenes-servicio.destroy', ['orden_servicio' => $orden->id])
                                                        : '#'; // Los recepcionistas no pueden eliminar
                                                @endphp
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ $showRoute }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 0.75rem;">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </a>
                                                    @if(Auth::user()->role === 'admin')
                                                        <a href="{{ $editRoute }}" class="btn btn-warning" style="padding: 8px 12px; font-size: 0.75rem;">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                            </svg>
                                                        </a>
                                                        <form action="{{ $deleteRoute }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" style="padding: 8px 12px; font-size: 0.75rem;" onclick="return confirm('¿Estás seguro de que quieres eliminar esta orden?')">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>