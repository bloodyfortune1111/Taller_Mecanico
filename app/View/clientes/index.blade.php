<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('clientes.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Nuevo Cliente</a>

                    <h3 class="text-lg font-medium text-gray-900 mt-4">Lista de Clientes</h3>
                    <ul>
                        @foreach($clientes as $cliente)
                            <li>
                                <a href="{{ route('clientes.show', $cliente->id) }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</a>
                                - {{ $cliente->telefono }}
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-blue-600 ml-2">Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-2">Eliminar</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>