<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-900 leading-tight tracking-wide drop-shadow">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-blue-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-xl font-bold text-blue-800 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Editar Cliente: <span class="ml-2">{{ $cliente->nombre }} {{ $cliente->apellido }}</span>
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

                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nombre" class="block text-base font-semibold text-blue-700 mb-1">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('nombre')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="apellido" class="block text-base font-semibold text-blue-700 mb-1">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $cliente->apellido) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('apellido')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-base font-semibold text-blue-700 mb-1">Email:</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="telefono" class="block text-base font-semibold text-blue-700 mb-1">Teléfono:</label>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('telefono')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="direccion" class="block text-base font-semibold text-blue-700 mb-1">Dirección:</label>
                                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}"
                                    class="mt-1 block w-full rounded-lg border-blue-300 shadow focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-gray-900">
                                @error('direccion')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 gap-4">
                            <a href="{{ route('clientes.index') }}"
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
                                Actualizar Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>