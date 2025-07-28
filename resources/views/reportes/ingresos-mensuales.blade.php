<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-primary-900 leading-tight">
                <i class="fas fa-chart-line mr-2"></i>
                {{ __('Ingresos Mensuales') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('reportes.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    Volver a Reportes
                </a>
                <a href="{{ route('reportes.ingresos-mensuales', ['pdf' => true]) }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    Exportar PDF
                </a>
            </div>
        </div>
    </x-slot>

<div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Resumen de ingresos --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Anual</p>
                        <p class="text-2xl font-bold text-green-600">
                            ${{ number_format($ingresos->sum('total'), 0, ',', '.') }}
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
                        <p class="text-sm font-medium text-gray-600">Promedio Mensual</p>
                        <p class="text-2xl font-bold text-blue-600">
                            ${{ number_format($ingresos->avg('total'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Mejor Mes</p>
                        <p class="text-lg font-bold text-purple-600">
                            @if($ingresos->isNotEmpty())
                                {{ $ingresos->sortByDesc('total')->first()->mes_nombre }}
                            @else
                                Sin datos
                            @endif
                        </p>
                        <p class="text-sm text-gray-500">
                            @if($ingresos->isNotEmpty())
                                ${{ number_format($ingresos->max('total'), 0, ',', '.') }}
                            @endif
                        </p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <i class="fas fa-trophy text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de ingresos por mes --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Ingresos por Mes - Enero a Agosto 2025
                </h3>
            </div>

            @if($ingresos->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-chart-bar text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Sin datos de ingresos</h3>
                    <p class="text-gray-500">No hay ingresos registrados para el año seleccionado.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mes
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Órdenes Completadas
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Ingresos
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Promedio por Orden
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    % del Total Anual
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($ingresos as $ingreso)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $ingreso->mes_nombre }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $ingreso->mes }}/2025
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $ingreso->ordenes_completadas }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-green-600">
                                            ${{ number_format($ingreso->total, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($ingreso->promedio_por_orden, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $porcentaje = $ingresos->sum('total') > 0 ? ($ingreso->total / $ingresos->sum('total')) * 100 : 0;
                                        @endphp
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $porcentaje }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-900">{{ number_format($porcentaje, 1) }}%</span>
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
</x-app-layout>
