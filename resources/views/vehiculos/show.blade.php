<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-900 leading-tight tracking-wide drop-shadow">
            {{ __('Detalles del Vehículo') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-blue-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold text-blue-800 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2M4 17V7a2 2 0 012-2h12a2 2 0 012 2v10M4 17h16"></path>
                        </svg>
                        Detalles del Vehículo: <span class="ml-2">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</span>
                    </h3>

                    <div class="border-t border-blue-200 pt-6">
                        <dl class="divide-y divide-blue-100">
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">ID</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->id }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Marca</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->marca }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Modelo</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->modelo }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Año</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->ano }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Matrícula</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->matricula }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Color</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->color }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Cliente Asociado</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">
                                    @if($vehiculo->cliente)
                                        <a href="{{ route('clientes.show', $vehiculo->cliente->id) }}" class="text-blue-600 hover:underline font-bold">
                                            {{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellido }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Fecha de Creación</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Última Actualización</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $vehiculo->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-end gap-4">
                        <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m2-2l-6 6"></path>
                            </svg>
                            Editar Vehículo
                        </a>
                        <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-5 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Eliminar Vehículo
                            </button>
                        </form>
                        <a href="{{ route('vehiculos.index') }}" class="inline-flex items-center px-5 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold hover:bg-gray-400 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Volver a la Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>