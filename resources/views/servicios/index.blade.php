<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Catálogo de Servicios') }}
                    </h2>
                    <p class="text-gray-600">Gestiona todos los servicios del taller mecánico</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="servicios-page max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Panel de estadísticas -->
            <div class="dashboard-stats mb-8">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Total Servicios</div>
                    <div class="stat-value">{{ $servicios->count() }}</div>
                    <div class="stat-change positive">Registrados</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Servicios Activos</div>
                    <div class="stat-value">{{ $servicios->where('activo', true)->count() }}</div>
                    <div class="stat-change positive">Disponibles</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Precio Promedio</div>
                    <div class="stat-value">${{ number_format($servicios->avg('precio_base'), 2) }}</div>
                    <div class="stat-change positive">Por servicio</div>
                </div>
            </div>

            <!-- Panel principal compacto -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                <div class="w-1 h-6 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-full mr-3"></div>
                                Lista de Servicios
                            </h3>
                            <p class="text-gray-600 mt-1 text-sm">
                                @if(auth()->user()->role === 'admin')
                                    Administra y gestiona todos los servicios disponibles
                                @else
                                    Consulta el catálogo de servicios disponibles
                                @endif
                            </p>
                        </div>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('servicios.create') }}" class="group inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-blue-700 hover:to-indigo-700 active:from-blue-800 active:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-105 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Nuevo Servicio
                            </a>
                        @else
                            <div class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Solo Consulta
                            </div>
                        @endif
                    </div>

                    @if (session('success'))
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 text-green-700 px-4 py-3 rounded-r-lg mb-4 shadow-sm" role="alert">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-400 text-red-700 px-6 py-4 rounded-r-xl mb-6 shadow-sm" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    @if ($servicios->isEmpty())
                        <div class="text-center py-16">
                            <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">No hay servicios registrados</h3>
                            @if(auth()->user()->role === 'admin')
                                <p class="text-gray-500 mb-6">Comienza agregando tu primer servicio al catálogo</p>
                                <a href="{{ route('servicios.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Crear Primer Servicio
                                </a>
                            @else
                                <p class="text-gray-500">El catálogo de servicios está vacío</p>
                            @endif
                        </div>
                    @else
                        <!-- Vista de tarjetas moderna -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($servicios as $servicio)
                                <div class="group bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                                    <!-- Header de la tarjeta -->
                                    <div class="p-6 border-b border-gray-100">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h4 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                                                    {{ $servicio->nombre }}
                                                </h4>
                                                @if($servicio->descripcion)
                                                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                                        {{ Str::limit($servicio->descripcion, 80) }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ring-1
                                                    @if($servicio->activo) servicios-badge-green ring-green-600/20
                                                    @else servicios-badge-red ring-red-600/20 @endif"
                                                    style="@if($servicio->activo) color: #14532d !important; background-color: #dcfce7 !important; @else color: #991b1b !important; background-color: #fee2e2 !important; @endif">
                                                    <div class="w-1.5 h-1.5 rounded-full mr-1.5 @if($servicio->activo) bg-green-500 @else bg-red-500 @endif"
                                                         style="@if($servicio->activo) background-color: #10b981 !important; @else background-color: #ef4444 !important; @endif"></div>
                                                    {{ $servicio->activo ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contenido de la tarjeta -->
                                    <div class="p-6">
                                        <div class="grid grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</p>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium servicios-badge-blue mt-1"
                                                      style="color: #1e3a8a !important; background-color: #dbeafe !important;">
                                                    {{ $servicio->categoria ?: 'Sin categoría' }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tiempo</p>
                                                <p class="text-sm font-semibold text-gray-900 mt-1">
                                                    {{ $servicio->tiempo_estimado ? $servicio->tiempo_estimado . ' min' : '-' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <div>
                                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Base</p>
                                                <p class="text-2xl font-bold text-green-600">
                                                    ${{ number_format($servicio->precio_base, 2) }}
                                                </p>
                                            </div>
                                            
                                            <!-- Botones de acción -->
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('servicios.show', $servicio->id) }}" 
                                                   class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                                   title="Ver detalles">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                @if(auth()->user()->role === 'admin')
                                                <a href="{{ route('servicios.edit', $servicio) }}" 
                                                   class="p-2 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all duration-200"
                                                   title="Editar">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este servicio?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200"
                                                            title="Eliminar">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
