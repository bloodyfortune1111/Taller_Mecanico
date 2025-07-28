<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            <i class="fas fa-chart-bar mr-2"></i>
            {{ __('Reportes Generales') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Panel de estadísticas -->
            <div class="dashboard-stats mb-8">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-car text-blue-600"></i>
                    </div>
                    <div class="stat-title">Vehículos Atendidos</div>
                    <div class="stat-value">{{ \App\Models\OrdenServicio::distinct('vehiculo_id')->count() }}</div>
                    <div class="stat-change positive">Este año</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tools text-green-600"></i>
                    </div>
                    <div class="stat-title">Servicios Realizados</div>
                    <div class="stat-value">{{ \App\Models\OrdenServicio::where('estado', 'finalizado')->count() }}</div>
                    <div class="stat-change positive">Completados</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign text-yellow-600"></i>
                    </div>
                    <div class="stat-title">Ingresos Totales</div>
                    <div class="stat-value">${{ number_format(\App\Models\OrdenServicio::where('pagado', true)->sum('costo_total'), 2) }}</div>
                    <div class="stat-change positive">MXN</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar text-purple-600"></i>
                    </div>
                    <div class="stat-title">Este Mes</div>
                    <div class="stat-value">{{ \App\Models\OrdenServicio::whereMonth('created_at', now()->month)->count() }}</div>
                    <div class="stat-change positive">Órdenes</div>
                </div>
            </div>

            <!-- Tarjetas de reportes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Vehículos por mes -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-100 rounded-xl mr-4">
                                    <i class="fas fa-car text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Vehículos Atendidos</h3>
                                    <p class="text-gray-600 text-sm">Por mes</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Consulta la cantidad de vehículos únicos atendidos cada mes del año.</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('reportes.vehiculos-mes') }}" 
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                Ver Reporte
                            </a>
                            <a href="{{ route('reportes.vehiculos-mes', ['pdf' => true]) }}" 
                               class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Servicios solicitados -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-xl mr-4">
                                    <i class="fas fa-tools text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Servicios Solicitados</h3>
                                    <p class="text-gray-600 text-sm">Más populares</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Identifica los servicios más demandados por los clientes.</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('reportes.servicios-solicitados') }}" 
                               class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                Ver Reporte
                            </a>
                            <a href="{{ route('reportes.servicios-solicitados', ['pdf' => true]) }}" 
                               class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ingresos mensuales -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="p-3 bg-yellow-100 rounded-xl mr-4">
                                    <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Ingresos Mensuales</h3>
                                    <p class="text-gray-600 text-sm">Por mes</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Analiza los ingresos generados cada mes del año.</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('reportes.ingresos-mensuales') }}" 
                               class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white text-center py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                Ver Reporte
                            </a>
                            <a href="{{ route('reportes.ingresos-mensuales', ['pdf' => true]) }}" 
                               class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ingresos por servicio -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="p-3 bg-purple-100 rounded-xl mr-4">
                                    <i class="fas fa-dollar-sign text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Ingresos por Servicio</h3>
                                    <p class="text-gray-600 text-sm">Rentabilidad</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Evalúa qué servicios generan mayores ingresos.</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('reportes.ingresos-servicio') }}" 
                               class="flex-1 bg-purple-600 hover:bg-purple-700 text-white text-center py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                Ver Reporte
                            </a>
                            <a href="{{ route('reportes.ingresos-servicio', ['pdf' => true]) }}" 
                               class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                                PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-blue-900 mb-2">Información sobre los reportes</h3>
                        <div class="text-blue-800 text-sm space-y-1">
                            <p>• Los reportes incluyen datos de órdenes finalizadas y pagadas</p>
                            <p>• Puedes filtrar por fechas específicas en cada reporte</p>
                            <p>• Los PDF se generan automáticamente con formato profesional</p>
                            <p>• Los datos se actualizan en tiempo real</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
