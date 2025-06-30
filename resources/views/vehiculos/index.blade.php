<x-app-layout>
       <x-slot name="header">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Gestión de Vehículos') }}
           </h2>
       </x-slot>

       <div class="py-12">
           <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <div class="p-6 text-gray-900">
                       <div class="flex justify-between items-center mb-4">
                           <h3 class="text-lg font-medium text-gray-900">Lista de Vehículos</h3>
                           <a href="{{ route('vehiculos.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                               Nuevo Vehículo
                           </a>
                       </div>

                       @if (session('success'))
                           <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                               <span class="block sm:inline">{{ session('success') }}</span>
                           </div>
                       @endif

                       @if ($vehiculos->isEmpty())
                           <p>No hay vehículos registrados.</p>
                       @else
                           <div class="overflow-x-auto">
                               <table class="min-w-full divide-y divide-gray-200">
                                   <thead class="bg-gray-50">
                                       <tr>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                       </tr>
                                   </thead>
                                   <tbody class="bg-white divide-y divide-gray-200">
                                       @foreach($vehiculos as $vehiculo)
                                           <tr>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $vehiculo->id }}</td>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $vehiculo->marca }}</td>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $vehiculo->modelo }}</td>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $vehiculo->matricula }}</td>
                                               {{-- Aquí usamos la relación cliente() definida en el modelo Vehiculo --}}
                                               <td class="px-6 py-4 whitespace-nowrap">
                                                   @if($vehiculo->cliente)
                                                       {{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellido }}
                                                   @else
                                                       N/A
                                                   @endif
                                               </td>
                                               <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                   <a href="{{ route('vehiculos.show', $vehiculo->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Ver</a>
                                                   <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Editar</a>
                                                   <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="inline">
                                                       @csrf
                                                       @method('DELETE')
                                                       <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">Eliminar</button>
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

       @if(session('showVehiculoModal'))
    <div 
        x-data="{ open: true }" 
        x-show="open"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
        x-cloak
    >
        <div class="bg-white p-8 rounded shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold mb-4">¿Registrar un vehículo?</h2>
            <p class="mb-6">¿Deseas registrar un vehículo para este cliente ahora?</p>
            <div class="flex justify-end gap-4">
                <button 
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                    x-on:click="open = false"
                >No, gracias</button>
                <a 
                    href="{{ route('vehiculos.create') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                >Sí, registrar auto</a>
            </div>
        </div>
    </div>
@endif
   </x-app-layout>