<x-app-layout>
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

                    <form method="POST" action="{{ route('ordenes-servicio.update', $ordenServicio->id) }}">
                        @csrf
                        @method('patch') {{-- O @method('PUT') --}}

                        <div>
                            <x-input-label for="cliente_id" :value="__('Cliente')" />
                            <select id="cliente_id" name="cliente_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ $ordenServicio->cliente_id == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('cliente_id')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="vehiculo_id" :value="__('Vehículo')" />
                            <select id="vehiculo_id" name="vehiculo_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ $ordenServicio->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>
                                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->matricula }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('vehiculo_id')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="mecanico_id" :value="__('Mecánico Asignado')" />
                            <select id="mecanico_id" name="mecanico_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Sin Asignar</option>
                                @foreach($mecanicos as $mecanico)
                                    <option value="{{ $mecanico->id }}" {{ ($ordenServicio->mecanico_id ?? 0) == $mecanico->id ? 'selected' : '' }}>
                                        {{ $mecanico->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('mecanico_id')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="diagnostico" :value="__('Diagnóstico')" />
                            <textarea id="diagnostico" name="diagnostico" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('diagnostico', $ordenServicio->diagnostico) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('diagnostico')" />
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="servicios_realizar" :value="__('Servicios a Realizar')" />
                            <textarea id="servicios_realizar" name="servicios_realizar" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('servicios_realizar', $ordenServicio->servicios_realizar) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('servicios_realizar')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="repuestos_necesarios" :value="__('Repuestos Necesarios')" />
                            <textarea id="repuestos_necesarios" name="repuestos_necesarios" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('repuestos_necesarios', $ordenServicio->repuestos_necesarios) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('repuestos_necesarios')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="costo_total" :value="__('Costo Total')" />
                            <x-text-input id="costo_total" name="costo_total" type="number" step="0.01" class="mt-1 block w-full" :value="old('costo_total', $ordenServicio->costo_total)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('costo_total')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="estado" :value="__('Estado')" />
                            <select id="estado" name="estado" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="recibido" {{ $ordenServicio->estado == 'recibido' ? 'selected' : '' }}>Recibido</option>
                                <option value="en_proceso" {{ $ordenServicio->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="finalizado" {{ $ordenServicio->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                <option value="entregado" {{ $ordenServicio->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                        </div>

                        <div class="mt-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="pagado" id="pagado" value="1" 
                                    {{ old('pagado', $ordenServicio->pagado ?? false) ? 'checked' : '' }} 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <label for="pagado" class="ml-2 block text-sm text-gray-900">¿Ha sido pagado?</label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('pagado')" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Actualizar Orden') }}
                            </x-primary-button>
                            <a href="{{ route('ordenes-servicio.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-2">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>