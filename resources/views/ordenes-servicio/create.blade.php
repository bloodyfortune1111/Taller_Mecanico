<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Orden de Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="card fade-in shadow-xl">
                <div class="card-header mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="card-title text-xl font-bold text-gray-900">Formulario de Nueva Orden de Servicio</h3>
                            <p class="card-subtitle text-gray-600">Completa la información para registrar la orden</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-6 text-gray-900">

                    <form action="{{ route('ordenes-servicio.store') }}" method="POST">
                        @csrf

                        <div class="mb-4 form-group">
                            <label for="cliente_id" class="form-label font-semibold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Cliente
                            </label>
                            <select name="cliente_id" id="cliente_id" required class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4 form-group">
                            <label for="vehiculo_id" class="form-label font-semibold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                                </svg>
                                Vehículo
                            </label>
                            <select name="vehiculo_id" id="vehiculo_id" required class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Seleccione un vehículo</option>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->matricula }})</option>
                                @endforeach
                            </select>
                            @error('vehiculo_id')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4 form-group">
                            <label for="mecanico_id" class="form-label font-semibold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Mecánico Asignado
                            </label>
                            <select name="mecanico_id" id="mecanico_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sin Asignar</option>
                                @foreach($mecanicos as $mecanico)
                                    <option value="{{ $mecanico->id }}" {{ old('mecanico_id') == $mecanico->id ? 'selected' : '' }}>{{ $mecanico->name }}</option>
                                @endforeach
                            </select>
                            @error('mecanico_id')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4 form-group">
                            <label for="diagnostico" class="form-label font-semibold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Diagnóstico
                            </label>
                            <textarea name="diagnostico" id="diagnostico" rows="4" placeholder="Ingrese el diagnóstico del problema..." class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('diagnostico') }}</textarea>
                            @error('diagnostico')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Sección de Servicios -->
                        <div class="mb-6 p-4 border border-blue-200 bg-blue-50 rounded-xl shadow">
                            <h4 class="text-md font-bold text-blue-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h6"></path></svg>
                                Servicios a Realizar
                            </h4>
                            
                            <div class="mb-4">
                                <label for="servicio_search" class="block text-sm font-medium text-gray-700">Buscar y Agregar Servicio</label>
                                <div class="flex gap-2 mt-1">
                                    <input type="text" id="servicio_search" placeholder="Buscar servicios..." 
                                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <select id="categoria_filter" class="w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Todas las categorías</option>
                                        <option value="Mantenimiento Preventivo">Mantenimiento Preventivo</option>
                                        <option value="Mantenimiento Mayor">Mantenimiento Mayor</option>
                                        <option value="Reparación">Reparación</option>
                                        <option value="Diagnóstico">Diagnóstico</option>
                                    </select>
                                </div>
                                <div id="busqueda_status" class="mt-1 text-sm text-gray-600 hidden"></div>
                            </div>

                            <div class="mb-4">
                                <label for="servicio_select" class="block text-sm font-medium text-gray-700">Seleccionar Servicio</label>
                                <div class="flex gap-2 mt-1">
                                    <select id="servicio_select" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Seleccione un servicio</option>
                                    </select>
                                    <button type="button" onclick="agregarServicio()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        Agregar
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="button" onclick="cargarRecomendados()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                    Servicios Recomendados
                                </button>
                            </div>

                            <div id="servicios_seleccionados" class="mb-4">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Servicios Seleccionados:</h5>
                                <div id="lista_servicios" class="space-y-2">
                                    <!-- Los servicios se agregarán aquí dinámicamente -->
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="servicios_realizar" class="block text-sm font-medium text-gray-700">Descripción Adicional de Servicios</label>
                                <textarea name="servicios_realizar" id="servicios_realizar" rows="3" placeholder="Detalles adicionales sobre los servicios..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('servicios_realizar') }}</textarea>
                                @error('servicios_realizar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sección de Piezas -->
                        <div class="mb-6 p-4 border border-green-200 bg-green-50 rounded-xl shadow">
                            <h4 class="text-md font-bold text-green-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Piezas y Repuestos
                            </h4>
                            
                            <div class="mb-4">
                                <label for="pieza_select" class="block text-sm font-medium text-gray-700">Agregar Pieza</label>
                                <div class="flex gap-2 mt-1">
                                    <select id="pieza_select" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Seleccione una pieza</option>
                                        @foreach($piezas as $pieza)
                                            <option value="{{ $pieza->id }}" data-precio="{{ $pieza->precio }}">
                                                {{ $pieza->nombre }} - ${{ number_format($pieza->precio, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" id="cantidad_pieza" min="1" value="1" class="w-20 rounded-md border-gray-300 shadow-sm" placeholder="Cant.">
                                    <button type="button" onclick="agregarPieza()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        Agregar
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="button" onclick="buscarPiezasPartsTech()" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                                    Buscar en PartsTech
                                </button>
                            </div>

                            <div id="piezas_seleccionadas" class="mb-4">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Piezas Seleccionadas:</h5>
                                <div id="lista_piezas" class="space-y-2">
                                    <!-- Las piezas se agregarán aquí dinámicamente -->
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="repuestos_necesarios" class="block text-sm font-medium text-gray-700">Descripción Adicional de Repuestos</label>
                                <textarea name="repuestos_necesarios" id="repuestos_necesarios" rows="3" placeholder="Detalles adicionales sobre repuestos..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('repuestos_necesarios') }}</textarea>
                                @error('repuestos_necesarios')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 form-group">
                            <label for="descripcion_problema" class="form-label font-semibold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2z"></path>
                                </svg>
                                Descripción del Problema
                            </label>
                            <textarea name="descripcion_problema" id="descripcion_problema" rows="4" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50">{{ old('descripcion_problema') }}</textarea>
                            @error('descripcion_problema')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="costo_total" class="block text-sm font-bold text-indigo-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 10v4"></path>
                                </svg>
                                Costo Total ($)
                            </label>
                            <div class="mt-1 p-3 bg-indigo-50 rounded-lg border border-indigo-200 shadow">
                                <div class="text-lg font-semibold text-indigo-800">
                                    Total: $<span id="costo_total_display">0.00</span>
                                </div>
                                <div class="text-sm text-indigo-600 mt-1">
                                    Servicios: $<span id="total_servicios">0.00</span> | 
                                    Piezas: $<span id="total_piezas">0.00</span>
                                </div>
                            </div>
                            <input type="hidden" name="costo_total" id="costo_total" value="0.00">
                            @error('costo_total')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-bold text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Estado
                            </label>
                            <select name="estado" id="estado" required class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow focus:border-gray-400 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                                <option value="recibido" {{ old('estado') == 'recibido' ? 'selected' : '' }}>Recibido</option>
                                <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="entregado" {{ old('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            </select>
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="pagado" id="pagado" value="1" {{ old('pagado') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <label for="pagado" class="ml-2 block text-sm text-gray-900 font-semibold">¿Ha sido pagado?</label>
                            </div>
                            @error('pagado')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-2">
                            <a href="{{ route('ordenes-servicio.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Cancelar
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Guardar Orden
                            </button>
                        </div>

                        <!-- Inputs ocultos para servicios y piezas -->
                        <div id="hidden_inputs"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para búsqueda en PartsTech -->
    <div id="partstech_modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Buscar Piezas en PartsTech</h3>
                
                <div class="mb-4">
                    <input type="text" id="search_term" placeholder="Buscar piezas..." class="w-full rounded-md border-gray-300 shadow-sm">
                </div>
                
                <div class="flex gap-2 mb-4">
                    <button onclick="buscarEnPartsTech()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Buscar
                    </button>
                    <button onclick="cerrarModalPartsTech()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cerrar
                    </button>
                </div>
                
                <div id="partstech_results" class="max-h-64 overflow-y-auto">
                    <!-- Resultados de búsqueda -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Arrays para mantener servicios y piezas seleccionados
        let serviciosSeleccionados = [];
        let piezasSeleccionadas = [];
        let serviciosDisponibles = [];

        // Cargar servicios al inicio
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado, iniciando carga de servicios...');
            cargarServicios();
            
            // Configurar eventos de búsqueda
            const searchInput = document.getElementById('servicio_search');
            const categoryFilter = document.getElementById('categoria_filter');
            
            if (searchInput) {
                searchInput.addEventListener('input', debounce(buscarServicios, 300));
                console.log('Evento de búsqueda configurado');
            }
            
            if (categoryFilter) {
                categoryFilter.addEventListener('change', filtrarPorCategoria);
                console.log('Evento de filtro configurado');
            }
        });

        /**
         * Función debounce para evitar múltiples llamadas
         */
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        /**
         * Cargar todos los servicios desde la API
         */
        async function cargarServicios() {
            try {
                mostrarEstadoBusqueda('Cargando servicios...');
                console.log('Cargando servicios desde API...');
                
                const response = await fetch('/api/servicios-taller/');
                const data = await response.json();
                
                console.log('Respuesta de la API:', data);
                
                if (data.success) {
                    serviciosDisponibles = data.data;
                    mostrarServicios(serviciosDisponibles);
                    mostrarEstadoBusqueda(`${serviciosDisponibles.length} servicios cargados`);
                } else {
                    console.error('Error al cargar servicios:', data.message);
                    mostrarEstadoBusqueda('Error al cargar servicios', true);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
                mostrarEstadoBusqueda('Error de conexión', true);
            }
        }

        /**
         * Mostrar estado de búsqueda
         */
        function mostrarEstadoBusqueda(mensaje, esError = false) {
            const statusDiv = document.getElementById('busqueda_status');
            if (statusDiv) {
                statusDiv.textContent = mensaje;
                statusDiv.className = `mt-1 text-sm ${esError ? 'text-red-600' : 'text-gray-600'}`;
                statusDiv.classList.remove('hidden');
                
                // Ocultar después de 3 segundos si no es error
                if (!esError) {
                    setTimeout(() => {
                        statusDiv.classList.add('hidden');
                    }, 3000);
                }
            }
        }

        /**
         * Buscar servicios por texto
         */
        async function buscarServicios() {
            const termino = document.getElementById('servicio_search').value.trim();
            
            console.log('Buscando servicios con término:', termino);
            
            if (termino === '') {
                cargarServicios();
                return;
            }
            
            try {
                mostrarEstadoBusqueda(`Buscando "${termino}"...`);
                const response = await fetch(`/api/servicios-taller/buscar?q=${encodeURIComponent(termino)}`);
                const data = await response.json();
                
                console.log('Resultados de búsqueda:', data);
                
                if (data.success) {
                    serviciosDisponibles = data.data;
                    mostrarServicios(serviciosDisponibles);
                    mostrarEstadoBusqueda(`${serviciosDisponibles.length} servicios encontrados`);
                } else {
                    console.error('Error en la búsqueda:', data.message);
                    mostrarEstadoBusqueda('Error en la búsqueda', true);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
                mostrarEstadoBusqueda('Error de conexión', true);
            }
        }

        /**
         * Filtrar servicios por categoría
         */
        async function filtrarPorCategoria() {
            const categoria = document.getElementById('categoria_filter').value;
            
            console.log('Filtrando por categoría:', categoria);
            
            try {
                mostrarEstadoBusqueda(categoria ? `Filtrando por ${categoria}...` : 'Cargando todos los servicios...');
                const url = categoria ? `/api/servicios-taller/categoria?categoria=${encodeURIComponent(categoria)}` : '/api/servicios-taller/';
                const response = await fetch(url);
                const data = await response.json();
                
                console.log('Resultados de filtro:', data);
                
                if (data.success) {
                    serviciosDisponibles = data.data;
                    mostrarServicios(serviciosDisponibles);
                    mostrarEstadoBusqueda(`${serviciosDisponibles.length} servicios ${categoria ? 'en ' + categoria : 'disponibles'}`);
                } else {
                    console.error('Error al filtrar:', data.message);
                    mostrarEstadoBusqueda('Error al filtrar', true);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
                mostrarEstadoBusqueda('Error de conexión', true);
            }
        }

        /**
         * Cargar servicios recomendados
         */
        async function cargarRecomendados() {
            const vehiculoSelect = document.getElementById('vehiculo_id');
            if (!vehiculoSelect.value) {
                alert('Por favor seleccione un vehículo primero');
                return;
            }
            
            try {
                const response = await fetch(`/api/servicios-taller/recomendados?tipo_vehiculo=auto&kilometraje=50000`);
                const data = await response.json();
                
                if (data.success) {
                    serviciosDisponibles = data.data;
                    mostrarServicios(serviciosDisponibles);
                    
                    // Actualizar el filtro para mostrar que estamos viendo recomendados
                    document.getElementById('categoria_filter').value = '';
                    document.getElementById('servicio_search').value = '';
                } else {
                    console.error('Error al cargar recomendados:', data.message);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
            }
        }

        /**
         * Mostrar servicios en el select
         */
        function mostrarServicios(servicios) {
            const select = document.getElementById('servicio_select');
            if (!select) {
                console.error('No se encontró el select de servicios');
                return;
            }
            
            select.innerHTML = '<option value="">Seleccione un servicio</option>';
            
            if (servicios.length === 0) {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'No se encontraron servicios';
                option.disabled = true;
                select.appendChild(option);
                return;
            }
            
            servicios.forEach(servicio => {
                const option = document.createElement('option');
                option.value = servicio.id;
                option.setAttribute('data-precio', servicio.precio);
                option.setAttribute('data-descripcion', servicio.descripcion);
                option.setAttribute('data-categoria', servicio.categoria);
                option.textContent = `${servicio.nombre} - $${parseFloat(servicio.precio).toFixed(2)} (${servicio.categoria})`;
                select.appendChild(option);
            });
            
            console.log(`Mostrando ${servicios.length} servicios en el select`);
        }

        /**
         * Agregar un servicio a la orden
         */
        function agregarServicio() {
            const select = document.getElementById('servicio_select');
            const servicioId = select.value;
            
            if (!servicioId) {
                alert('Por favor seleccione un servicio');
                return;
            }

            // Buscar el servicio en los disponibles
            const servicio = serviciosDisponibles.find(s => s.id == servicioId);
            if (!servicio) {
                alert('Servicio no encontrado');
                return;
            }

            // Verificar si ya está agregado
            if (serviciosSeleccionados.find(s => s.id == servicioId)) {
                alert('Este servicio ya está agregado');
                return;
            }

            // Agregar al array
            serviciosSeleccionados.push({
                id: servicioId,
                nombre: servicio.nombre,
                precio: parseFloat(servicio.precio),
                categoria: servicio.categoria
            });

            // Actualizar vista
            actualizarListaServicios();
            actualizarCostoTotal();
            
            // Limpiar selección
            select.value = '';
        }

        /**
         * Agregar una pieza a la orden
         */
        function agregarPieza() {
            const select = document.getElementById('pieza_select');
            const cantidadInput = document.getElementById('cantidad_pieza');
            const piezaId = select.value;
            const piezaTexto = select.options[select.selectedIndex].text;
            const precio = parseFloat(select.options[select.selectedIndex].getAttribute('data-precio'));
            const cantidad = parseInt(cantidadInput.value) || 1;

            if (!piezaId) {
                alert('Por favor seleccione una pieza');
                return;
            }

            // Verificar si ya está agregada
            const piezaExistente = piezasSeleccionadas.find(p => p.id == piezaId);
            if (piezaExistente) {
                piezaExistente.cantidad += cantidad;
            } else {
                piezasSeleccionadas.push({
                    id: piezaId,
                    nombre: piezaTexto.split(' - ')[0],
                    precio: precio,
                    cantidad: cantidad
                });
            }

            // Actualizar vista
            actualizarListaPiezas();
            actualizarCostoTotal();
            
            // Limpiar selección
            select.value = '';
            cantidadInput.value = 1;
        }

        /**
         * Eliminar un servicio
         */
        function eliminarServicio(servicioId) {
            serviciosSeleccionados = serviciosSeleccionados.filter(s => s.id != servicioId);
            actualizarListaServicios();
            actualizarCostoTotal();
        }

        /**
         * Eliminar una pieza
         */
        function eliminarPieza(piezaId) {
            piezasSeleccionadas = piezasSeleccionadas.filter(p => p.id != piezaId);
            actualizarListaPiezas();
            actualizarCostoTotal();
        }

        /**
         * Actualizar la lista visual de servicios
         */
        function actualizarListaServicios() {
            const container = document.getElementById('lista_servicios');
            container.innerHTML = '';

            serviciosSeleccionados.forEach(servicio => {
                const div = document.createElement('div');
                div.className = 'flex justify-between items-center p-2 bg-blue-50 rounded border';
                div.innerHTML = `
                    <div>
                        <span class="font-medium">${servicio.nombre}</span>
                        <span class="text-sm text-gray-500 ml-2">(${servicio.categoria})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-medium">$${servicio.precio.toFixed(2)}</span>
                        <button type="button" onclick="eliminarServicio(${servicio.id})" 
                                class="text-red-600 hover:text-red-800 text-xl">
                            ×
                        </button>
                    </div>
                `;
                container.appendChild(div);
            });

            // Actualizar inputs ocultos
            actualizarInputsOcultos();
        }

        /**
         * Actualizar la lista visual de piezas
         */
        function actualizarListaPiezas() {
            const container = document.getElementById('lista_piezas');
            container.innerHTML = '';

            piezasSeleccionadas.forEach(pieza => {
                const div = document.createElement('div');
                div.className = 'flex justify-between items-center p-2 bg-green-50 rounded border';
                div.innerHTML = `
                    <span>${pieza.nombre} (x${pieza.cantidad})</span>
                    <div class="flex items-center gap-2">
                        <span class="font-medium">$${(pieza.precio * pieza.cantidad).toFixed(2)}</span>
                        <button type="button" onclick="eliminarPieza(${pieza.id})" 
                                class="text-red-600 hover:text-red-800">
                            ×
                        </button>
                    </div>
                `;
                container.appendChild(div);
            });

            // Actualizar inputs ocultos
            actualizarInputsOcultos();
        }

        /**
         * Actualizar el costo total
         */
        function actualizarCostoTotal() {
            const totalServicios = serviciosSeleccionados.reduce((sum, servicio) => sum + servicio.precio, 0);
            const totalPiezas = piezasSeleccionadas.reduce((sum, pieza) => sum + (pieza.precio * pieza.cantidad), 0);
            const total = totalServicios + totalPiezas;

            document.getElementById('total_servicios').textContent = totalServicios.toFixed(2);
            document.getElementById('total_piezas').textContent = totalPiezas.toFixed(2);
            document.getElementById('costo_total_display').textContent = total.toFixed(2);
            document.getElementById('costo_total').value = total.toFixed(2);
        }

        /**
         * Actualizar inputs ocultos para envío del formulario
         */
        function actualizarInputsOcultos() {
            const container = document.getElementById('hidden_inputs');
            container.innerHTML = '';

            // Agregar servicios
            serviciosSeleccionados.forEach((servicio, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `servicios[${index}]`;
                input.value = servicio.id;
                container.appendChild(input);
            });

            // Agregar piezas
            piezasSeleccionadas.forEach((pieza, index) => {
                const inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = `piezas[${index}][id]`;
                inputId.value = pieza.id;
                
                const inputCantidad = document.createElement('input');
                inputCantidad.type = 'hidden';
                inputCantidad.name = `piezas[${index}][cantidad]`;
                inputCantidad.value = pieza.cantidad;
                
                container.appendChild(inputId);
                container.appendChild(inputCantidad);
            });
        }

        /**
         * Buscar piezas en PartsTech
         */
        function buscarPiezasPartsTech() {
            const vehiculoSelect = document.getElementById('vehiculo_id');
            if (!vehiculoSelect.value) {
                alert('Por favor seleccione un vehículo primero');
                return;
            }
            
            document.getElementById('partstech_modal').classList.remove('hidden');
        }

        /**
         * Realizar búsqueda en PartsTech
         */
        function buscarEnPartsTech() {
            const searchTerm = document.getElementById('search_term').value;
            const vehiculoId = document.getElementById('vehiculo_id').value;
            
            if (!searchTerm) {
                alert('Por favor ingrese un término de búsqueda');
                return;
            }

            // Aquí iría la llamada AJAX a la API de PartsTech
            document.getElementById('partstech_results').innerHTML = `
                <div class="text-center py-4">
                    <p class="text-gray-600">Función de búsqueda en PartsTech pendiente de implementación</p>
                    <p class="text-sm text-gray-500 mt-2">Vehículo: ${vehiculoId}, Búsqueda: "${searchTerm}"</p>
                </div>
            `;
        }

        /**
         * Cerrar modal de PartsTech
         */
        function cerrarModalPartsTech() {
            document.getElementById('partstech_modal').classList.add('hidden');
            document.getElementById('search_term').value = '';
            document.getElementById('partstech_results').innerHTML = '';
        }
    </script>
</x-app-layout>