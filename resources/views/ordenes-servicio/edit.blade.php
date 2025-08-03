<x-app-layout>
@php
$piezasArray = $ordenServicio->piezas
    ? $ordenServicio->piezas->map(function($pieza) {
        return [
            'id' => $pieza->id,
            'nombre' => $pieza->nombre,
            'precio' => $pieza->precio,
            'cantidad' => $pieza->pivot->cantidad
        ];
    })->values()->toArray()
    : [];
@endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Orden de Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Orden de Servicio #{{ $ordenServicio->id }}</h3>
                    
                    <!-- Mensaje informativo -->
                    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-400 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    <strong>Modo de Edición Limitado:</strong> Solo se pueden agregar piezas adicionales. Los demás campos están bloqueados para preservar la integridad de la orden.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('ordenes-servicio.update', ['orden_servicio' => $ordenServicio->id]) }}" method="POST">                        
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                            <select name="cliente_id" id="cliente_id" required disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ $ordenServicio->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="cliente_id" value="{{ $ordenServicio->cliente_id }}">
                            @error('cliente_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="vehiculo_id" class="block text-sm font-medium text-gray-700">Vehículo</label>
                            <select name="vehiculo_id" id="vehiculo_id" required disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">
                                <option value="">Seleccione un vehículo</option>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ $ordenServicio->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->matricula }})</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="vehiculo_id" value="{{ $ordenServicio->vehiculo_id }}">
                            @error('vehiculo_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="mecanico_id" class="block text-sm font-medium text-gray-700">Mecánico Asignado</label>
                            <select name="mecanico_id" id="mecanico_id" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">
                                <option value="">Sin Asignar</option>
                                @foreach($mecanicos as $mecanico)
                                    <option value="{{ $mecanico->id }}" {{ $ordenServicio->mecanico_id == $mecanico->id ? 'selected' : '' }}>{{ $mecanico->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="mecanico_id" value="{{ $ordenServicio->mecanico_id }}">
                            @error('mecanico_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="diagnostico" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                            <textarea name="diagnostico" id="diagnostico" rows="4" readonly placeholder="Ingrese el diagnóstico del problema..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">{{ $ordenServicio->diagnostico }}</textarea>
                            @error('diagnostico')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descripcion_problema" class="block text-sm font-medium text-gray-700">Descripción del Problema</label>
                            <textarea name="descripcion_problema" id="descripcion_problema" rows="4" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">{{ $ordenServicio->descripcion_problema }}</textarea>
                            @error('descripcion_problema')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sección de Servicios (Bloqueada) -->
                        <div class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <h4 class="text-md font-medium text-gray-600 mb-4">Servicios a Realizar (Solo Lectura)</h4>
                            
                            <div class="mb-4">
                                <label for="servicio_select" class="block text-sm font-medium text-gray-500">Agregar Servicio</label>
                                <div class="flex gap-2 mt-1">
                                    <select id="servicio_select" disabled class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">
                                        <option value="">Seleccione un servicio</option>
                                        @foreach($servicios as $servicio)
                                            <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio_base }}">
                                                {{ $servicio->nombre }} - ${{ number_format($servicio->precio_base, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded cursor-not-allowed">
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

                            <div class="mb-4">
                                <label for="servicios_realizar" class="block text-sm font-medium text-gray-500">Descripción Adicional de Servicios</label>
                                <textarea name="servicios_realizar" id="servicios_realizar" rows="3" readonly placeholder="Detalles adicionales sobre los servicios..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">{{ $ordenServicio->servicios_realizar }}</textarea>
                                @error('servicios_realizar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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

                            <div class="mb-4">
                                <label for="repuestos_necesarios" class="block text-sm font-medium text-gray-500">Descripción Adicional de Repuestos</label>
                                <textarea name="repuestos_necesarios" id="repuestos_necesarios" rows="3" readonly placeholder="Detalles adicionales sobre repuestos..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">{{ $ordenServicio->repuestos_necesarios }}</textarea>
                                @error('repuestos_necesarios')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="costo_total" class="block text-sm font-medium text-gray-700">Costo Total ($)</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-300">
                                <div class="text-lg font-semibold text-gray-800">
                                    Total: $<span id="costo_total_display">{{ number_format($ordenServicio->costo_total, 2) }}</span>
                                </div>
                                <div class="text-sm text-gray-600 mt-1">
                                    Servicios: $<span id="total_servicios">0.00</span> | 
                                    Piezas: $<span id="total_piezas">0.00</span>
                                </div>
                            </div>
                            <input type="hidden" name="costo_total" id="costo_total" value="{{ $ordenServicio->costo_total }}">
                            @error('costo_total')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-500">Estado</label>
                            <select name="estado" id="estado" required disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">
                                <option value="recibido" {{ $ordenServicio->estado == 'recibido' ? 'selected' : '' }}>Recibido</option>
                                <option value="en_proceso" {{ $ordenServicio->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="finalizado" {{ $ordenServicio->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="entregado" {{ $ordenServicio->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            </select>
                            <input type="hidden" name="estado" value="{{ $ordenServicio->estado }}">
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="pagado" id="pagado" value="1" {{ $ordenServicio->pagado ? 'checked' : '' }} disabled class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100">
                                <label for="pagado" class="ml-2 block text-sm text-gray-500">¿Ha sido pagado?</label>
                                <input type="hidden" name="pagado" value="{{ $ordenServicio->pagado ? '1' : '0' }}">
                            </div>
                            @error('pagado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('ordenes-servicio.show', ['orden_servicio' => $ordenServicio->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Actualizar Orden
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

        // Inicializar con servicios y piezas existentes
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar servicios existentes
            serviciosSeleccionados = @json(
                $ordenServicio->servicios
                    ? $ordenServicio->servicios->map(function($servicio) {
                        return [
                            'id' => $servicio->id,
                            'nombre' => $servicio->nombre,
                            'precio' => $servicio->precio_base
                        ];
                    })->values()->toArray()
                    : []
            );

            // Cargar piezas existentes
            piezasSeleccionadas = @json($piezasArray);

            // Actualizar vistas
            actualizarListaServicios();
            actualizarListaPiezas();
            actualizarCostoTotal();
        });

        /**
         * Agregar un servicio a la orden (DESHABILITADO)
         */
        function agregarServicio() {
            // Función deshabilitada - solo se permite agregar piezas
            return false;
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

            // Verificar si ya está agregada para acumular cantidad
            if (piezaExistente) {
                // Si ya existe, solo incrementar la cantidad
                piezaExistente.cantidad += cantidad;
                piezaExistente.stockDisponible = stockDisponible; // Actualizar stock disponible
            } else {
                // Si no existe, agregar nueva pieza
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
         * Eliminar un servicio por índice (DESHABILITADO)
         */
        function eliminarServicio(index) {
            // Función deshabilitada - no se pueden eliminar servicios
            return false;
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
         * Actualizar la lista visual de servicios (SOLO LECTURA)
         */
        function actualizarListaServicios() {
            const container = document.getElementById('lista_servicios');
            container.innerHTML = '';

            serviciosSeleccionados.forEach((servicio, index) => {
                const div = document.createElement('div');
                div.className = 'flex justify-between items-center p-2 bg-gray-100 rounded border';
                div.innerHTML = `
                    <span class="text-gray-600">${servicio.nombre}</span>
                    <div class="flex items-center gap-2">
                        <span class="font-medium text-gray-600">$${servicio.precio.toFixed(2)}</span>
                        <span class="text-gray-400 text-sm">(Bloqueado)</span>
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
    </script>
</x-app-layout>