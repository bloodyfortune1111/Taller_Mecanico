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
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Detalles de la Nueva Orden de Servicio</h3>

                        {{-- Muestra errores de validación --}}
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('ordenes-servicio.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente:</label>
                                <select name="cliente_id" id="cliente_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Selecciona un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }} {{ $cliente->apellido }} ({{ $cliente->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="vehiculo_id" class="block text-sm font-medium text-gray-700">Vehículo:</label>
                                <select name="vehiculo_id" id="vehiculo_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Selecciona un vehículo</option>
                                    @foreach($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                            {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->matricula }}) - Cliente: {{ $vehiculo->cliente->nombre ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehiculo_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="mecanico_id" class="block text-sm font-medium text-gray-700">Mecánico Asignado (opcional):</label>
                                <select name="mecanico_id" id="mecanico_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Sin Asignar</option>
                                    @foreach($mecanicos as $mecanico)
                                        <option value="{{ $mecanico->id }}" {{ old('mecanico_id') == $mecanico->id ? 'selected' : '' }}>
                                            {{ $mecanico->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mecanico_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="descripcion_problema" class="block text-sm font-medium text-gray-700">Descripción del Problema:</label>
                                <textarea name="descripcion_problema" id="descripcion_problema" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('descripcion_problema') }}</textarea>
                                @error('descripcion_problema')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="costo_total" class="block text-sm font-medium text-gray-700">Costo Total:</label>
                                <input type="number" step="0.01" name="costo_total" id="costo_total" value="{{ old('costo_total', 0.00) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('costo_total')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="estado" class="block text-sm font-medium text-gray-700">Estado:</label>
                                <select name="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @php
                                        $estados = ['recibido', 'en_proceso', 'finalizado', 'entregado'];
                                    @endphp
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado }}" {{ old('estado') == $estado ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('estado')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('ordenes-servicio.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Crear Orden
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    