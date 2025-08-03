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

                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-red-800">Error al crear la orden</h3>
                                    <div class="mt-1 text-sm">
                                        {!! session('error') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @php
                        // Determinar la ruta correcta basada en el rol del usuario
                        $storeRoute = Auth::user()->role === 'admin' 
                            ? route('ordenes-servicio.store') 
                            : route('recepcionista.ordenes-servicio.store');
                    @endphp
                    
                    <form action="{{ $storeRoute }}" method="POST" onsubmit="return validarFormulario()">
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
                                <option value="">Primero seleccione un cliente</option>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" 
                                            data-cliente-id="{{ $vehiculo->cliente_id }}" 
                                            {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}
                                            style="display: none;">
                                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }} - {{ $vehiculo->matricula }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehiculo_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="mecanico_id" class="block text-sm font-medium text-gray-700">Mecánico Asignado (Opcional)</label>
                            <select name="mecanico_id" id="mecanico_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sin asignar</option>
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
                            <textarea name="diagnostico" id="diagnostico" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('diagnostico') }}</textarea>
                            @error('diagnostico')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sección de Servicios -->
                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <h4 class="text-md font-medium text-gray-800 mb-4">Servicios a Realizar</h4>
                            
                            <div class="mb-4">
                                <label for="servicio_select" class="block text-sm font-medium text-gray-700">Agregar Servicio</label>
                                <div class="flex gap-2 mt-1">
                                    <select id="servicio_select" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Seleccione un servicio</option>
                                        @foreach($servicios as $servicio)
                                            <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio_base }}">
                                                {{ $servicio->nombre }} - ${{ number_format($servicio->precio_base, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" onclick="agregarServicio()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        Agregar
                                    </button>
                                </div>
                            </div>

                            <div id="servicios_seleccionados" class="mb-4">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Servicios Seleccionados:</h5>
                                <div id="lista_servicios" class="space-y-2">
                                    <!-- Los servicios se agregarán aquí dinámicamente -->
                                </div>
                            </div>
                        </div>

                        <!-- Sección de Piezas -->
                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <h4 class="text-md font-medium text-gray-800 mb-4">Piezas y Repuestos</h4>
                            
                            <div class="mb-4">
                                <label for="pieza_select" class="block text-sm font-medium text-gray-700">Agregar Pieza</label>
                                <div class="flex gap-2 mt-1">
                                    <select id="pieza_select" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Seleccione una pieza</option>
                                        @foreach($piezas as $pieza)
                                            <option value="{{ $pieza->id }}" 
                                                    data-precio="{{ $pieza->precio }}" 
                                                    data-stock="{{ $pieza->stock }}"
                                                    {{ $pieza->stock <= 0 ? 'disabled' : '' }}>
                                                {{ $pieza->nombre }} - ${{ number_format($pieza->precio, 2) }} 
                                                (Stock: {{ $pieza->stock }}{{ $pieza->stock <= 0 ? ' - AGOTADO' : '' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" id="cantidad_pieza" min="1" value="1" class="w-20 rounded-md border-gray-300 shadow-sm" placeholder="Cant.">
                                    <button type="button" onclick="agregarPieza()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        Agregar
                                    </button>
                                </div>
                            </div>

                            <div id="piezas_seleccionadas" class="mb-4">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Piezas Seleccionadas:</h5>
                                <div id="lista_piezas" class="space-y-2">
                                    <!-- Las piezas se agregarán aquí dinámicamente -->
                                </div>
                            </div>
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
                            <input type="hidden" name="costo_total" id="costo_total" value="0">
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

                        <div class="mb-6">
                            <label for="pagado" class="flex items-center">
                                <input type="checkbox" name="pagado" id="pagado" value="1" {{ old('pagado') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700 font-medium">Pagado</span>
                            </label>
                            @error('pagado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            @php
                                // Determinar la ruta correcta para volver basada en el rol del usuario
                                $indexRoute = Auth::user()->role === 'admin' 
                                    ? route('ordenes-servicio.index') 
                                    : route('recepcionista.ordenes-servicio.index');
                            @endphp
                            <a href="{{ $indexRoute }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Crear Orden
                            </button>
                        </div>

                        <!-- Inputs ocultos para servicios y piezas -->
                        <div id="hidden_inputs"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Arrays para mantener servicios y piezas seleccionados
        let serviciosSeleccionados = [];
        let piezasSeleccionadas = [];

        document.addEventListener('DOMContentLoaded', function() {
            // Filtrar vehículos por cliente seleccionado
            document.getElementById('cliente_id').addEventListener('change', function() {
                const clienteId = this.value;
                const vehiculoSelect = document.getElementById('vehiculo_id');
                const vehiculoOptions = vehiculoSelect.querySelectorAll('option[data-cliente-id]');
                
                // Resetear el select de vehículos
                vehiculoSelect.value = '';
                
                if (clienteId) {
                    vehiculoSelect.querySelector('option[value=""]').textContent = 'Seleccione un vehículo';
                    
                    vehiculoOptions.forEach(option => {
                        if (option.dataset.clienteId === clienteId) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                } else {
                    vehiculoSelect.querySelector('option[value=""]').textContent = 'Primero seleccione un cliente';
                    vehiculoOptions.forEach(option => {
                        option.style.display = 'none';
                    });
                }
            });

            // Actualizar vista inicial
            actualizarListaServicios();
            actualizarListaPiezas();
            actualizarCostoTotal();
        });

        /**
         * Agregar un servicio a la orden
         */
        function agregarServicio() {
            const select = document.getElementById('servicio_select');
            const servicioId = select.value;
            const servicioTexto = select.options[select.selectedIndex].text;
            const precio = parseFloat(select.options[select.selectedIndex].getAttribute('data-precio'));

            if (!servicioId) {
                alert('Por favor seleccione un servicio');
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
                nombre: servicioTexto.split(' - ')[0],
                precio: precio
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
            const stockDisponible = parseInt(select.options[select.selectedIndex].getAttribute('data-stock'));
            const cantidad = parseInt(cantidadInput.value) || 1;

            if (!piezaId) {
                alert('Por favor seleccione una pieza');
                return;
            }

            // Validar stock disponible
            if (stockDisponible <= 0) {
                alert('Esta pieza está agotada (stock: 0)');
                return;
            }

            // Calcular cantidad total requerida (incluyendo lo ya seleccionado)
            const piezaExistente = piezasSeleccionadas.find(p => p.id == piezaId);
            const cantidadYaSeleccionada = piezaExistente ? piezaExistente.cantidad : 0;
            const cantidadTotal = cantidadYaSeleccionada + cantidad;

            if (cantidadTotal > stockDisponible) {
                alert(`Stock insuficiente. Disponible: ${stockDisponible}, Ya seleccionado: ${cantidadYaSeleccionada}, Solicitado: ${cantidad}`);
                return;
            }

            // Agregar o actualizar la pieza
            if (piezaExistente) {
                piezaExistente.cantidad += cantidad;
            } else {
                piezasSeleccionadas.push({
                    id: piezaId,
                    nombre: piezaTexto.split(' - ')[0],
                    precio: precio,
                    cantidad: cantidad,
                    stockDisponible: stockDisponible
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
                    <span>${servicio.nombre}</span>
                    <div class="flex items-center gap-2">
                        <span class="font-medium">$${servicio.precio.toFixed(2)}</span>
                        <button type="button" onclick="eliminarServicio(${servicio.id})" 
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
         * Actualizar la lista visual de piezas
         */
        function actualizarListaPiezas() {
            const container = document.getElementById('lista_piezas');
            container.innerHTML = '';

            piezasSeleccionadas.forEach(pieza => {
                const div = document.createElement('div');
                div.className = 'flex justify-between items-center p-2 bg-green-50 rounded border';
                
                // Determinar color de advertencia si el stock es bajo
                let colorClase = 'text-gray-600';
                let advertencia = '';
                if (pieza.stockDisponible !== undefined) {
                    const stockRestante = pieza.stockDisponible - pieza.cantidad;
                    if (stockRestante < 0) {
                        colorClase = 'text-red-600 font-bold';
                        advertencia = ' ⚠️ EXCEDE STOCK';
                    } else if (stockRestante <= 2) {
                        colorClase = 'text-orange-600';
                        advertencia = ` (Quedarán: ${stockRestante})`;
                    }
                }
                
                div.innerHTML = `
                    <div>
                        <span>${pieza.nombre} (x${pieza.cantidad})</span>
                        <div class="text-xs ${colorClase}">${advertencia}</div>
                    </div>
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
         * Validar formulario antes del envío
         */
        function validarFormulario() {
            // Verificar si hay piezas que excedan el stock
            const piezasProblematicas = piezasSeleccionadas.filter(pieza => {
                return pieza.stockDisponible !== undefined && pieza.cantidad > pieza.stockDisponible;
            });

            if (piezasProblematicas.length > 0) {
                let mensaje = 'Las siguientes piezas exceden el stock disponible:\n\n';
                piezasProblematicas.forEach(pieza => {
                    mensaje += `• ${pieza.nombre}: Solicitado ${pieza.cantidad}, Disponible ${pieza.stockDisponible}\n`;
                });
                mensaje += '\nPor favor, ajuste las cantidades antes de continuar.';
                
                alert(mensaje);
                return false;
            }

            // Verificar si hay al menos un servicio o una pieza
            if (serviciosSeleccionados.length === 0 && piezasSeleccionadas.length === 0) {
                alert('Debe seleccionar al menos un servicio o una pieza para crear la orden.');
                return false;
            }

            return true;
        }
    </script>
</x-app-layout>