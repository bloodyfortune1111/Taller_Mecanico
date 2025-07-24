<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Recepción') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Estadísticas principales -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-blue-100">Órdenes Pendientes</p>
                                <p class="text-2xl font-semibold">{{ $ordenes_pendientes }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gradient-to-r from-green-500 to-green-600 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-100">Órdenes Hoy</p>
                                <p class="text-2xl font-semibold">{{ $ordenes_hoy }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-purple-100">Total Clientes</p>
                                <p class="text-2xl font-semibold">{{ $clientes_total }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-yellow-100">Total Vehículos</p>
                                <p class="text-2xl font-semibold">{{ $vehiculos_total }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accesos rápidos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('ordenes-servicio.create') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h5 class="mb-2 text-lg font-bold text-gray-900">Nueva Orden</h5>
                    <p class="text-sm text-gray-600">Crear una nueva orden de servicio</p>
                </a>

                <a href="{{ route('ordenes-servicio.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h5 class="mb-2 text-lg font-bold text-gray-900">Ver Órdenes</h5>
                    <p class="text-sm text-gray-600">Consultar órdenes de servicio</p>
                </a>

                <a href="{{ route('vehiculos.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h5 class="mb-2 text-lg font-bold text-gray-900">Vehículos</h5>
                    <p class="text-sm text-gray-600">Gestionar vehículos</p>
                </a>

                <a href="{{ route('servicios.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h5 class="mb-2 text-lg font-bold text-gray-900">Servicios</h5>
                    <p class="text-sm text-gray-600">Catálogo de servicios</p>
                </a>
            </div>

            <!-- Órdenes recientes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Órdenes Recientes</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehículo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($ordenes_recientes as $orden)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ $orden->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $orden->cliente->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $orden->vehiculo->marca ?? 'N/A' }} {{ $orden->vehiculo->modelo ?? '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($orden->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                        @elseif($orden->estado == 'en_progreso') bg-blue-100 text-blue-800
                                        @elseif($orden->estado == 'completado') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($orden->estado) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $orden->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('ordenes-servicio.show', $orden->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No hay órdenes recientes
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
