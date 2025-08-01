<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-900 leading-tight tracking-wide drop-shadow">
            {{ __('Detalles del Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-blue-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold text-blue-800 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Detalles del Cliente: <span class="ml-2">{{ $cliente->nombre }} {{ $cliente->apellido }}</span>
                    </h3>

                    <div class="border-t border-blue-200 pt-6">
                        <dl class="divide-y divide-blue-100">
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">ID</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->id }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Nombre</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->nombre }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Apellido</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->apellido }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Email</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->email }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Teléfono</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->telefono }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Dirección</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->direccion }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Fecha de Creación</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                            <div class="px-4 py-4 grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                                <dt class="text-base font-semibold text-blue-700">Última Actualización</dt>
                                <dd class="col-span-2 text-base text-gray-800 bg-blue-50 rounded px-3 py-2">{{ $cliente->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-end gap-4">
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m2-2l-6 6"></path>
                            </svg>
                            Editar Cliente
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-5 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Eliminar Cliente
                            </button>
                        </form>
                        <a href="{{ route('clientes.index') }}" class="inline-flex items-center px-5 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold hover:bg-gray-400 transition">
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
