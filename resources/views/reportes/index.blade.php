<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-primary-900 leading-tight">
            <i class="fas fa-chart-bar mr-2"></i>
            {{ __('Reportes Generales') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="reportes-page max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Panel de estadísticas -->
            <div class="dashboard-stats mb-8">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8l2-2h2a1 1 0 011 1v6a1 1 0 01-1 1h-2l-2 2z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Vehículos Atendidos</div>
                    <div class="stat-value">{{ $estadisticas['vehiculos_atendidos'] }}</div>
                    <div class="stat-change positive">Únicos</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Servicios Completados</div>
                    <div class="stat-value">{{ $estadisticas['servicios_realizados'] }}</div>
                    <div class="stat-change positive">Finalizados</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Ingresos Totales</div>
                    <div class="stat-value">${{ number_format($estadisticas['ingresos_totales'], 2) }}</div>
                    <div class="stat-change positive">Pagados</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Este Mes</div>
                    <div class="stat-value">{{ $estadisticas['ordenes_este_mes'] }}</div>
                    <div class="stat-change positive">Órdenes</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Pendientes</div>
                    <div class="stat-value">{{ $estadisticas['ordenes_pendientes'] }}</div>
                    <div class="stat-change {{ $estadisticas['ordenes_pendientes'] > 0 ? 'negative' : 'positive' }}">
                        {{ $estadisticas['ordenes_pendientes'] > 0 ? 'En proceso' : 'Al día' }}
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Clientes Activos</div>
                    <div class="stat-value">{{ $estadisticas['clientes_activos'] }}</div>
                    <div class="stat-change positive">Con órdenes</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Promedio por Orden</div>
                    <div class="stat-value">${{ number_format($estadisticas['promedio_orden'], 2) }}</div>
                    <div class="stat-change positive">Valor medio</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Servicios Activos</div>
                    <div class="stat-value">{{ $estadisticas['servicios_activos'] }}</div>
                    <div class="stat-change positive">Disponibles</div>
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
        </div>
    </div>
</x-app-layout>
