<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            <i class="fas fa-file-invoice mr-2"></i>
            {{ __('Facturas') }}
        </h2>
    </x-slot>

<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-file-invoice mr-2"></i>
                Generar Facturas
            </h2>
            <p class="text-gray-600 mt-1">Órdenes terminadas y pagadas listas para facturar</p>
        </div>

        <div class="p-6">
            @if($ordenesTerminadas->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Orden #
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cliente
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Vehículo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha Finalización
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($ordenesTerminadas as $orden)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ str_pad($orden->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $orden->cliente->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $orden->vehiculo->matricula }} - {{ $orden->vehiculo->anio }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-green-600">
                                        ${{ number_format($orden->costo_total, 2) }} MXN
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $orden->updated_at ? $orden->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Finalizada y Pagada
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('recepcionista.facturas.preview', $orden->id) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md text-sm text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-200"
                                       target="_blank">
                                        <i class="fas fa-eye mr-1"></i>
                                        Vista Previa
                                    </a>
                                    <a href="{{ route('recepcionista.facturas.generar', $orden->id) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-green-300 rounded-md text-sm text-green-700 bg-green-50 hover:bg-green-100 transition-colors duration-200">
                                        <i class="fas fa-download mr-1"></i>
                                        Descargar PDF
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-6">
                    {{ $ordenesTerminadas->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-file-invoice text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay órdenes listas para facturar</h3>
                    <p class="text-gray-500 mb-4">Las órdenes deben estar finalizadas y pagadas para generar facturas.</p>
                    <a href="{{ route('ordenes-servicio.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Ver Órdenes de Servicio
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.table-auto {
    border-collapse: separate;
    border-spacing: 0;
}

.table-auto thead th:first-child {
    border-top-left-radius: 0.5rem;
}

.table-auto thead th:last-child {
    border-top-right-radius: 0.5rem;
}

.hover\:bg-gray-50:hover {
    transition: background-color 0.2s ease-in-out;
}
</style>
</x-app-layout>
