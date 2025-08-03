<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-gradient-to-r from-purple-600 to-blue-700 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Catálogo de Piezas') }}
                    </h2>
                    <p class="text-gray-600">Gestiona tu inventario de piezas y repuestos</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Panel de estadísticas -->
            <div class="dashboard-stats mb-8">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Total Piezas</div>
                    <div class="stat-value">{{ $piezasLocales->total() }}</div>
                    <div class="stat-change positive">Inventario</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">En Stock</div>
                    <div class="stat-value">{{ $piezasLocales->where('stock', '>', 0)->count() }}</div>
                    <div class="stat-change positive">Disponibles</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Stock Bajo</div>
                    <div class="stat-value">{{ $piezasLocales->where('stock', '<', 10)->count() }}</div>
                    <div class="stat-change negative">Reabastecer</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Valor Inventario</div>
                    <div class="stat-value text-gray-900">${{ number_format($piezasLocales->sum(function($p) { return $p->precio * $p->stock; }), 2) }}</div>
                    <div class="stat-change positive">Total</div>
                </div>
            </div>

            <!-- Panel principal compacto -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <!-- Header con acciones -->

                    @if (session('success'))
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 text-green-700 px-6 py-4 rounded-r-xl mb-6 shadow-sm notification-enter" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-400 text-red-700 px-6 py-4 rounded-r-xl mb-6 shadow-sm notification-enter" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <!-- Filtros de búsqueda mejorados -->
                    <div class="mb-8 bg-gradient-to-r from-gray-50 to-blue-50 p-6 rounded-xl border border-gray-200 shadow-sm">
                        <form method="GET" action="{{ route('piezas.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <svg class="w-4 h-4 inline mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Buscar Pieza
                                </label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                       placeholder="Nombre, número de parte, marca..."
                                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 form-input-focus">
                            </div>
                            
                            <div>
                                <label for="categoria" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <svg class="w-4 h-4 inline mr-1 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Categoría
                                </label>
                                <select name="categoria" id="categoria" 
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 form-input-focus">
                                    <option value="">Todas</option>
                                    @foreach($categorias as $key => $value)
                                        <option value="{{ $key }}" {{ request('categoria') === $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="flex items-end">
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg btn-glow">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    Filtrar
                                </button>
                            </div>
                            
                            <div class="flex items-end">
                                <a href="{{ route('piezas.index') }}" class="w-full text-center bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700 px-4 py-3 rounded-lg hover:from-gray-400 hover:to-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 font-medium transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Limpiar
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Grid de piezas locales - Diseño moderno con tarjetas -->
                    @forelse($piezasLocales as $pieza)
                        @if($loop->first)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @endif
                            <!-- Tarjeta de pieza -->
                            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-hover fade-in">
                                <!-- Imagen de la pieza -->
                                <div class="relative h-48 bg-gradient-to-br from-gray-50 to-gray-100">
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    
                                    <!-- Estado de la pieza - overlay -->
                                    <div class="absolute top-3 right-3">
                                        @if($pieza->activo)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Activo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Inactivo
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Badge de disponibilidad -->
                                    <div class="absolute top-3 left-3">
                                        @switch($pieza->disponibilidad)
                                            @case('disponible')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500 text-white shadow-lg badge-pulse">
                                                    <div class="w-2 h-2 bg-white rounded-full mr-1.5 animate-pulse"></div>
                                                    Disponible
                                                </span>
                                                @break
                                            @case('agotado')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white shadow-lg">
                                                    <div class="w-2 h-2 bg-white rounded-full mr-1.5"></div>
                                                    Agotado
                                                </span>
                                                @break
                                            @case('descontinuado')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-500 text-white shadow-lg">
                                                    <div class="w-2 h-2 bg-white rounded-full mr-1.5"></div>
                                                    Descontinuado
                                                </span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>

                                <!-- Contenido de la tarjeta -->
                                <div class="p-6">
                                    <!-- Título y número de parte -->
                                    <div class="mb-4">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $pieza->nombre }}</h3>
                                        <p class="text-sm text-gray-500 font-mono bg-gray-50 px-2 py-1 rounded inline-block">
                                            {{ $pieza->numero_parte }}
                                        </p>
                                    </div>

                                    <!-- Información principal -->
                                    <div class="space-y-3 mb-6">
                                        <!-- Categoría -->
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Categoría:</span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $categorias[$pieza->categoria] ?? $pieza->categoria }}
                                            </span>
                                        </div>

                                        <!-- Marca -->
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Marca:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $pieza->marca ?? 'Sin marca' }}
                                            </span>
                                        </div>

                                        <!-- Proveedor -->
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Proveedor:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $pieza->proveedor ?? 'Local' }}
                                            </span>
                                        </div>

                                        <!-- Stock -->
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Stock:</span>
                                            <span class="text-sm font-bold {{ $pieza->stock <= 5 ? 'text-red-600' : 'text-green-600' }}">
                                                {{ $pieza->stock }} unidades
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Precio destacado -->
                                    <div class="mb-6">
                                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 border border-green-200">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-medium text-gray-700">Precio</span>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-green-600">
                                                        ${{ number_format($pieza->precio, 2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Acciones -->
                                    <div class="flex space-x-2">
                                        <button onclick="openEditStockModal({{ $pieza->id }}, {{ json_encode($pieza->nombre) }}, {{ $pieza->stock }})" 
                                                class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 px-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg btn-glow">
                                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 5a1 1 0 100-2V1.5a.5.5 0 01.5-.5h3a.5.5 0 01.5.5V3a1 1 0 100 2v6.5a.5.5 0 01-.5.5h-3a.5.5 0 01-.5-.5V5zM3 7a1 1 0 000 2v5a1 1 0 102 0V9a1 1 0 000-2V7zM15 7a1 1 0 100 2v5a1 1 0 102 0V9a1 1 0 100-2V7z"></path>
                                            </svg>
                                            Editar Stock
                                        </button>
                                        @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('piezas.edit', $pieza) }}" 
                                           class="flex-1 bg-purple-600 hover:bg-purple-700 text-white text-center py-2 px-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg btn-glow">
                                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                            Editar
                                        </a>
                                        <form action="{{ route('piezas.destroy', $pieza) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta pieza?')"
                                                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg btn-glow">
                                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                                </svg>
                                                Eliminar
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @if($loop->last)
                        </div>
                        @endif
                    @empty
                        <div class="text-center py-12">
                            <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron piezas</h3>
                            <p class="text-gray-500 mb-6">
                                @if(auth()->user()->role === 'admin')
                                    Comienza agregando tu primera pieza al inventario.
                                @else
                                    No hay piezas registradas en el sistema.
                                @endif
                            </p>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('piezas.create') }}" 
                               class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 btn-glow">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Agregar Primera Pieza
                            </a>
                            @else
                            <span class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-500 bg-gray-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Solo Consulta
                            </span>
                            @endif
                        </div>
                    @endforelse

                    <!-- Paginación mejorada -->
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-xl shadow-lg px-6 py-4 border border-gray-200">
                            {{ $piezasLocales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar stock -->
    <div id="editStockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Editar Stock
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="pieza-name">
                                    Actualizar cantidad de stock
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <form id="editStockForm" class="mt-4">
                        <div class="mb-4">
                            <label for="nuevo_stock" class="block text-sm font-medium text-gray-700">Nueva Cantidad de Stock</label>
                            <input type="number" id="nuevo_stock" name="nuevo_stock" min="0" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <p class="mt-1 text-xs text-gray-500">Stock actual: <span id="stock-actual">0</span></p>
                        </div>
                    </form>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="updateStock()" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Actualizar Stock
                    </button>
                    <button type="button" onclick="closeEditStockModal()" 
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentPiezaId = null;

        // Variables para el modal de stock
        function openEditStockModal(piezaId, piezaNombre, stockActual) {
            console.log('Opening modal with:', piezaId, piezaNombre, stockActual);
            currentPiezaId = piezaId;
            document.getElementById('pieza-name').textContent = `Actualizar stock para: ${piezaNombre}`;
            document.getElementById('stock-actual').textContent = stockActual;
            document.getElementById('nuevo_stock').value = stockActual;
            document.getElementById('editStockModal').classList.remove('hidden');
            console.log('Modal should be visible now');
        }

        function closeEditStockModal() {
            document.getElementById('editStockModal').classList.add('hidden');
            currentPiezaId = null;
        }

        function updateStock() {
            if (!currentPiezaId) return;
            
            const nuevoStock = document.getElementById('nuevo_stock').value;
            
            if (nuevoStock === '' || nuevoStock < 0) {
                alert('Ingresa una cantidad válida');
                return;
            }

            fetch(`/piezas/${currentPiezaId}/update-stock`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    stock: parseInt(nuevoStock)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al actualizar el stock');
            });

            closeEditStockModal();
        }
    </script>
    @endpush
</x-app-layout>
