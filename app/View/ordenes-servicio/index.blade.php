    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Órdenes de Servicio') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Lista de Órdenes de Servicio</h3>
                            <a href="{{ route('ordenes-servicio.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Crear Nueva Orden</a>
                        </div>

                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($ordenesServicio->isEmpty())
                            <p>No hay órdenes de servicio registradas.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehículo</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mecánico</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Costo Total</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($ordenesServicio as $orden)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $orden->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $orden->mecanico->name ?? 'N/A' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($orden->estado == 'recibido') bg-blue-100 text-blue-800
                                                        @elseif($orden->estado == 'en_proceso') bg-yellow-100 text-yellow-800
                                                        @elseif($orden->estado == 'finalizado') bg-green-100 text-green-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                        {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($orden->costo_total, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('ordenes-servicio.show', $orden->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                                                    <a href="{{ route('ordenes-servicio.edit', $orden->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Editar</a>
                                                    <form action="{{ route('ordenes-servicio.destroy', $orden->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta orden?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>