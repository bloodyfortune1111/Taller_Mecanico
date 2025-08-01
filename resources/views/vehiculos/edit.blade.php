<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-900 leading-tight tracking-wide drop-shadow">
            {{ __('Editar Vehículo') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-blue-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-xl font-bold text-blue-800 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2M4 17V7a2 2 0 012-2h12a2 2 0 012 2v10M4 17h16"></path>
                        </svg>
                        Editar Vehículo: <span class="ml-2">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</span>
                    </h3>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="cliente_id" class="block text-base font-semibold text-blue-700 mb-1">Cliente:</label>
                                <select name="cliente_id" id="cliente_id"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                    <option value="">Selecciona un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id', $vehiculo->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }} {{ $cliente->apellido }} ({{ $cliente->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="marca" class="block text-base font-semibold text-blue-700 mb-1">Marca:</label>
                                <input type="text" name="marca" id="marca" value="{{ old('marca', $vehiculo->marca) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('marca')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="modelo" class="block text-base font-semibold text-blue-700 mb-1">Modelo:</label>
                                <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $vehiculo->modelo) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('modelo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="ano" class="block text-base font-semibold text-blue-700 mb-1">Año:</label>
                                <input type="number" name="ano" id="ano" value="{{ old('ano', $vehiculo->ano) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('ano')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="matricula" class="block text-base font-semibold text-blue-700 mb-1">Matrícula:</label>
                                <input type="text" name="matricula" id="matricula" value="{{ old('matricula', $vehiculo->matricula) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('matricula')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="color" class="block text-base font-semibold text-blue-700 mb-1">Color:</label>
                                <input type="text" name="color" id="color" value="{{ old('color', $vehiculo->color) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('color')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 gap-4">
                            <a href="{{ route('vehiculos.index') }}"
                               class="inline-flex items-center px-5 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold hover:bg-gray-400 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Actualizar Vehículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>