<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Orden de Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Formulario de Nueva Orden de Servicio</h3>

                    <form action="{{ route('ordenes-servicio.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                            <select name="cliente_id" id="cliente_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="vehiculo_id" class="block text-sm font-medium text-gray-700">Vehículo</label>
                            <select name="vehiculo_id" id="vehiculo_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Seleccione un vehículo</option>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->matricula }})</option>
                                @endforeach
                            </select>
                            @error('vehiculo_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="mecanico_id" class="block text-sm font-medium text-gray-700">Mecánico Asignado</label>
                            <select name="mecanico_id" id="mecanico_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sin Asignar</option>
                                @foreach($mecanicos as $mecanico)
                                    <option value="{{ $mecanico->id }}" {{ old('mecanico_id') == $mecanico->id ? 'selected' : '' }}>{{ $mecanico->name }}</option>
                                @endforeach
                            </select>
                            @error('mecanico_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="diagnostico" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                            <textarea name="diagnostico" id="diagnostico" rows="4" placeholder="Ingrese el diagnóstico del problema..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('diagnostico') }}</textarea>
                            @error('diagnostico')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sección de Servicios -->
                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <h4 class="text-md font-medium text-gray-800 mb-4">Servicios a Realizar</h4>
                            
                            <div class="mb-4">
                                <label for="categoria_filter" class="block text-sm font-medium text-gray-700">Filtrar por Categoría</label>
                                <select id="categoria_filter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Todas las categorías</option>
                                    <option value="Mantenimiento Preventivo">Mantenimiento Preventivo</option>
                                    <option value="Mantenimiento Mayor">Mantenimiento Mayor</option>
                                    <option value="Reparación">Reparación</option>
                                    <option value="Diagnóstico">Diagnóstico</option>
                                </select>
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
                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <h4 class="text-md font-medium text-gray-800 mb-4">Piezas y Repuestos</h4>
                            
                            <div class="mb-4">
                                <label for="categoria_pieza_filter" class="block text-sm font-medium text-gray-700">Filtrar por Categoría</label>
                                <select id="categoria_pieza_filter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Todas las categorías</option>
                                    <option value="Motor">Motor</option>
                                    <option value="Frenos">Frenos</option>
                                    <option value="Transmisión">Transmisión</option>
                                    <option value="Suspensión">Suspensión</option>
                                    <option value="Eléctrico">Eléctrico</option>
                                    <option value="Carrocería">Carrocería</option>
                                    <option value="Neumáticos">Neumáticos</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="pieza_select" class="block text-sm font-medium text-gray-700">Seleccionar Pieza</label>
                                <div class="flex gap-2 mt-1">
                                    <select id="pieza_select" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Seleccione una pieza</option>
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

                        <div class="mb-4">
                            <label for="descripcion_problema" class="block text-sm font-medium text-gray-700">Descripción del Problema</label>
                            <textarea name="descripcion_problema" id="descripcion_problema" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('descripcion_problema') }}</textarea>
                            @error('descripcion_problema')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="costo_total" class="block text-sm font-medium text-gray-700">Costo Total ($)</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-300">
                                <div class="text-lg font-semibold text-gray-800">
                                    Total: $<span id="costo_total_display">0.00</span>
                                </div>
                                <div class="text-sm text-gray-600 mt-1">
                                    Servicios: $<span id="total_servicios">0.00</span> | 
                                    Piezas: $<span id="total_piezas">0.00</span>
                                </div>
                            </div>
                            <input type="hidden" name="costo_total" id="costo_total" value="0.00">
                            @error('costo_total')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="recibido" {{ old('estado') == 'recibido' ? 'selected' : '' }}>Recibido</option>
                                <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="entregado" {{ old('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            </select>
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="pagado" id="pagado" value="1" {{ old('pagado') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <label for="pagado" class="ml-2 block text-sm text-gray-900">¿Ha sido pagado?</label>
                            </div>
                            @error('pagado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('ordenes-servicio.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
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
        let piezasDisponibles = [];

        // Cargar servicios al inicio
        document.addEventListener('DOMContentLoaded', function() {
            cargarServicios();
            cargarPiezas();
            
            // Configurar evento de filtro por categoría
            document.getElementById('categoria_filter').addEventListener('change', filtrarPorCategoria);
            document.getElementById('categoria_pieza_filter').addEventListener('change', filtrarPiezasPorCategoria);
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
                const response = await fetch('/api/servicios-taller/');
                const data = await response.json();
                
                if (data.success) {
                    serviciosDisponibles = data.data;
                    mostrarServicios(serviciosDisponibles);
                } else {
                    console.error('Error al cargar servicios:', data.message);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
            }
        }

        /**
         * Cargar todas las piezas desde la API
         */
        async function cargarPiezas() {
            try {
                const response = await fetch('/api/piezas-taller/');
                const data = await response.json();
                
                if (data.success) {
                    piezasDisponibles = data.data;
                    mostrarPiezas(piezasDisponibles);
                } else {
                    console.error('Error al cargar piezas:', data.message);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
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
         * Filtrar servicios por categoría
         */
        async function filtrarPorCategoria() {
            const categoria = document.getElementById('categoria_filter').value;
            
            try {
                const url = categoria ? `/api/servicios-taller/categoria?categoria=${encodeURIComponent(categoria)}` : '/api/servicios-taller/';
                const response = await fetch(url);
                const data = await response.json();
                
                if (data.success) {
                    serviciosDisponibles = data.data;
                    mostrarServicios(serviciosDisponibles);
                } else {
                    console.error('Error al filtrar:', data.message);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
            }
        }

        /**
         * Filtrar piezas por categoría
         */
        async function filtrarPiezasPorCategoria() {
            const categoria = document.getElementById('categoria_pieza_filter').value;
            
            try {
                const url = categoria ? `/api/piezas-taller/categoria?categoria=${encodeURIComponent(categoria)}` : '/api/piezas-taller/';
                const response = await fetch(url);
                const data = await response.json();
                
                if (data.success) {
                    piezasDisponibles = data.data;
                    mostrarPiezas(piezasDisponibles);
                } else {
                    console.error('Error al filtrar piezas:', data.message);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
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
         * Mostrar piezas en el select
         */
        function mostrarPiezas(piezas) {
            const select = document.getElementById('pieza_select');
            if (!select) {
                console.error('No se encontró el select de piezas');
                return;
            }
            
            select.innerHTML = '<option value="">Seleccione una pieza</option>';
            
            if (piezas.length === 0) {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'No se encontraron piezas';
                option.disabled = true;
                select.appendChild(option);
                return;
            }
            
            piezas.forEach(pieza => {
                const option = document.createElement('option');
                option.value = pieza.id;
                option.setAttribute('data-precio', pieza.precio);
                option.setAttribute('data-marca', pieza.marca);
                option.setAttribute('data-categoria', pieza.categoria);
                option.setAttribute('data-stock', pieza.stock);
                
                // Mostrar información relevante en el texto de la opción
                const stockText = pieza.stock > 0 ? `(${pieza.stock} disponible)` : '(Sin stock)';
                const disponibilidadText = pieza.disponibilidad === 'disponible' ? '' : ' - No disponible';
                
                option.textContent = `${pieza.nombre} - ${pieza.marca} - $${parseFloat(pieza.precio).toFixed(2)} ${stockText}${disponibilidadText}`;
                
                // Deshabilitar si no hay stock o no está disponible
                if (pieza.stock <= 0 || pieza.disponibilidad !== 'disponible') {
                    option.disabled = true;
                    option.style.color = '#999';
                }
                
                select.appendChild(option);
            });
            
            console.log(`Mostrando ${piezas.length} piezas en el select`);
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
            const cantidad = parseInt(cantidadInput.value) || 1;

            if (!piezaId) {
                alert('Por favor seleccione una pieza');
                return;
            }

            // Buscar la pieza en los disponibles
            const pieza = piezasDisponibles.find(p => p.id == piezaId);
            if (!pieza) {
                alert('Pieza no encontrada');
                return;
            }

            // Verificar stock
            if (pieza.stock <= 0) {
                alert('Esta pieza no tiene stock disponible');
                return;
            }

            // Verificar disponibilidad
            if (pieza.disponibilidad !== 'disponible') {
                alert('Esta pieza no está disponible');
                return;
            }

            // Verificar si ya está agregada
            const piezaExistente = piezasSeleccionadas.find(p => p.id == piezaId);
            if (piezaExistente) {
                // Verificar que no exceda el stock
                if (piezaExistente.cantidad + cantidad > pieza.stock) {
                    alert(`No hay suficiente stock. Stock disponible: ${pieza.stock}, ya agregado: ${piezaExistente.cantidad}`);
                    return;
                }
                piezaExistente.cantidad += cantidad;
            } else {
                // Verificar que no exceda el stock
                if (cantidad > pieza.stock) {
                    alert(`No hay suficiente stock. Stock disponible: ${pieza.stock}`);
                    return;
                }
                
                piezasSeleccionadas.push({
                    id: piezaId,
                    nombre: pieza.nombre,
                    marca: pieza.marca,
                    precio: parseFloat(pieza.precio),
                    cantidad: cantidad,
                    categoria: pieza.categoria
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
                    <div>
                        <span class="font-medium">${pieza.nombre}</span>
                        <span class="text-sm text-gray-500 ml-2">(${pieza.marca} - x${pieza.cantidad})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-medium">$${(pieza.precio * pieza.cantidad).toFixed(2)}</span>
                        <button type="button" onclick="eliminarPieza(${pieza.id})" 
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