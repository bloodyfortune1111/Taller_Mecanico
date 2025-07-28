<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-primary-900 leading-tight">
                <i class="fas fa-chart-pie mr-2"></i>
                {{ __('Ingresos por Tipo de Servicio') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('reportes.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    Volver a Reportes
                </a>
                <a href="{{ route('reportes.ingresos-servicio', ['pdf' => true]) }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    Exportar PDF
                </a>
            </div>
        </div>
    </x-slot>

<div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Resumen general --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Ingresos</p>
                        <p class="text-2xl font-bold text-green-600">
                            ${{ number_format($ingresosPorServicio->sum('total_ingresos'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tipos de Servicios</p>
                        <p class="text-2xl font-bold text-blue-600">
                            {{ $ingresosPorServicio->count() }}
                        </p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-tools text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Servicio Más Rentable</p>
                        <p class="text-lg font-bold text-purple-600">
                            @if($ingresosPorServicio->isNotEmpty())
                                {{ $ingresosPorServicio->sortByDesc('total_ingresos')->first()->tipo_servicio }}
                            @else
                                Sin datos
                            @endif
                        </p>
                        <p class="text-sm text-gray-500">
                            @if($ingresosPorServicio->isNotEmpty())
                                ${{ number_format($ingresosPorServicio->max('total_ingresos'), 0, ',', '.') }}
                            @endif
                        </p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <i class="fas fa-trophy text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Promedio por Servicio</p>
                        <p class="text-2xl font-bold text-orange-600">
                            ${{ number_format($ingresosPorServicio->avg('precio_promedio'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-full">
                        <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de ingresos por servicio --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Análisis de Ingresos por Tipo de Servicio
                </h3>
            </div>

            @if($ingresosPorServicio->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-chart-pie text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Sin datos de servicios</h3>
                    <p class="text-gray-500">No hay servicios registrados para el período seleccionado.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipo de Servicio
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Ingresos
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Precio Promedio
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    % del Total
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rentabilidad
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($ingresosPorServicio->sortByDesc('total_ingresos') as $ingreso)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                                    <i class="fas fa-wrench text-white text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $ingreso->tipo_servicio }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $ingreso->cantidad }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-green-600">
                                            ${{ number_format($ingreso->total_ingresos, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($ingreso->precio_promedio, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $porcentaje = $ingresosPorServicio->sum('total_ingresos') > 0 ? ($ingreso->total_ingresos / $ingresosPorServicio->sum('total_ingresos')) * 100 : 0;
                                        @endphp
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $porcentaje }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-900">{{ number_format($porcentaje, 1) }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($porcentaje >= 20)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Alta
                                            </span>
                                        @elseif($porcentaje >= 10)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Media
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Baja
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
