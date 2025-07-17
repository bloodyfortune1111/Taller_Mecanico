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
                    <div class="stat-value">${{ number_format($piezasLocales->sum(function($p) { return $p->precio * $p->stock; }), 2) }}</div>
                    <div class="stat-change positive">Total</div>
                </div>
            </div>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-black">Stock Bajo</h3>
                            <p class="text-xl font-bold text-black">{{ $piezasLocales->where('stock', '<=', 5)->where('stock', '>', 0)->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-md p-4 stats-card">
                    <div class="flex items-center">
                        <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-black">Valor Total</h3>
                            <p class="text-xl font-bold text-black">${{ number_format($piezasLocales->sum(function($p) { return $p->precio * $p->stock; }), 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Estadísticas de Conexión PartsTech compactas -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6 border border-gray-200">
                <div class="p-4 text-gray-900">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-900">Estado de Conexión PartsTech</h3>
                                <p class="text-xs text-gray-600">API de piezas mecánicas en tiempo real</p>
                            </div>
                        </div>
                        <div id="connection-status" class="flex items-center">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600"></div>
                            <span class="ml-2 text-xs text-gray-600 font-medium">Verificando conexión...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel principal compacto -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <!-- Header con acciones -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                                <div class="w-1 h-8 bg-gradient-to-b from-purple-500 to-indigo-600 rounded-full mr-3"></div>
                                Catálogo de Piezas
                            </h3>
                            <p class="text-gray-600 mt-1">Gestiona tu inventario de piezas y repuestos</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('piezas.create') }}" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-105 shadow-lg hover:shadow-xl btn-glow">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Nueva Pieza
                            </a>
                            
                            <button onclick="openPartsSearchModal()" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-105 shadow-lg hover:shadow-xl btn-glow">
                                <svg class="w-5 h-5 mr-2 icon-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Buscar PartsTech
                            </button>
                        </div>
                    </div>

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
                                    @if($pieza->imagen_url)
                                        <img src="{{ $pieza->imagen_url }}" alt="{{ $pieza->nombre }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full">
                                            <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
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
                                        <a href="{{ route('piezas.show', $pieza) }}" 
                                           class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg btn-glow">
                                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Ver
                                        </a>
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
                            <p class="text-gray-500 mb-6">Comienza agregando tu primera pieza al inventario.</p>
                            <a href="{{ route('piezas.create') }}" 
                               class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 btn-glow">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Agregar Primera Pieza
                            </a>
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

            <!-- Resultados de PartsTech API (si hay búsqueda) -->
            @if(!empty($piezasApi))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Resultados de PartsTech API</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($piezasApi as $apiPieza)
                                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                    @if($apiPieza['image_url'])
                                        <img src="{{ $apiPieza['image_url'] }}" alt="{{ $apiPieza['name'] }}" class="w-full h-32 object-cover rounded-md mb-3">
                                    @endif
                                    
                                    <h4 class="font-semibold text-gray-900">{{ $apiPieza['name'] }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $apiPieza['part_number'] }}</p>
                                    <p class="text-sm text-gray-500 mb-2">{{ $apiPieza['description'] }}</p>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-green-600">${{ number_format($apiPieza['price'], 2) }}</span>
                                        <button onclick="importPart('{{ $apiPieza['part_number'] }}', '{{ $apiPieza['external_id'] }}')" 
                                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Importar
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de búsqueda PartsTech -->
    <div id="partsSearchModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Buscar Piezas en PartsTech</h3>
                    
                    <form id="partsSearchForm">
                        <div class="mb-4">
                            <label for="vehiculo_select" class="block text-sm font-medium text-gray-700">Vehículo</label>
                            <select id="vehiculo_select" name="vehiculo_id" required 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Selecciona un vehículo</option>
                                <!-- Se llenarán via AJAX -->
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="categoria_select" class="block text-sm font-medium text-gray-700">Categoría (opcional)</label>
                            <select id="categoria_select" name="categoria" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Todas las categorías</option>
                                @foreach($categorias as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="searchPartsTech()" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Buscar
                    </button>
                    <button type="button" onclick="closePartsSearchModal()" 
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Verificar conexión PartsTech al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            checkPartsTechConnection();
            loadVehiculos();
        });

        function checkPartsTechConnection() {
            fetch('{{ route("piezas.test-connection") }}')
                .then(response => response.json())
                .then(data => {
                    const statusDiv = document.getElementById('connection-status');
                    if (data.connected) {
                        statusDiv.innerHTML = `
                            <div class="flex items-center text-green-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm">Conectado</span>
                            </div>
                        `;
                    } else {
                        statusDiv.innerHTML = `
                            <div class="flex items-center text-red-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm">Sin conexión</span>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error checking connection:', error);
                    document.getElementById('connection-status').innerHTML = `
                        <div class="flex items-center text-red-600">
                            <span class="text-sm">Error de conexión</span>
                        </div>
                    `;
                });
        }

        function loadVehiculos() {
            // Cargar vehículos para el modal
            fetch('{{ route("vehiculos.index") }}')
                .then(response => response.text())
                .then(html => {
                    // Extraer opciones de vehículos del HTML
                    // Esto es una simplificación - idealmente tendrías una ruta API separada
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    // Implementar lógica para extraer vehículos
                });
        }

        function openPartsSearchModal() {
            document.getElementById('partsSearchModal').classList.remove('hidden');
        }

        function closePartsSearchModal() {
            document.getElementById('partsSearchModal').classList.add('hidden');
        }

        function searchPartsTech() {
            const form = document.getElementById('partsSearchForm');
            const formData = new FormData(form);
            
            if (!formData.get('vehiculo_id')) {
                alert('Selecciona un vehículo');
                return;
            }

            // Mostrar loading
            // Implementar búsqueda AJAX
            console.log('Searching PartsTech with:', Object.fromEntries(formData));
            
            closePartsSearchModal();
        }

        function importPart(partNumber, externalId) {
            if (!confirm(`¿Importar la pieza ${partNumber}?`)) {
                return;
            }

            fetch('{{ route("piezas.import-partstech") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    part_number: partNumber,
                    external_id: externalId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pieza importada exitosamente');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al importar la pieza');
            });
        }
    </script>
    @endpush
</x-app-layout>
