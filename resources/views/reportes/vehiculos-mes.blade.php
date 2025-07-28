<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-primary-900 leading-tight">
                <i class="fas fa-car mr-2"></i>
                {{ __('Vehículos Atendidos por Mes') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('reportes.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    Volver a Reportes
                </a>
                <a href="{{ route('reportes.vehiculos-mes', ['year' => $año, 'pdf' => true]) }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    Exportar PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resultados -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Vehículos Atendidos - Enero a Agosto 2025
                    </h3>
                </div>

                @if($vehiculosPorMes->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mes
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vehículos Únicos
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Órdenes
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Promedio Órdenes/Vehículo
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($vehiculosPorMes as $dato)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ ucfirst($dato->nombre_mes) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-blue-600 font-semibold">
                                            {{ $dato->total_vehiculos }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $dato->total_ordenes }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ number_format($dato->total_ordenes / $dato->total_vehiculos, 2) }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        Total Año
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-blue-600">
                                        {{ $vehiculosPorMes->sum('total_vehiculos') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $vehiculosPorMes->sum('total_ordenes') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $vehiculosPorMes->count() > 0 ? number_format($vehiculosPorMes->sum('total_ordenes') / $vehiculosPorMes->sum('total_vehiculos'), 2) : '0.00' }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-chart-bar text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay datos</h3>
                        <p class="text-gray-500">No se encontraron vehículos atendidos para el año {{ $año }}.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
