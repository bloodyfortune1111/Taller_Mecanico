<x-app-layout>
       <x-slot name="header">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Gestión de Clientes') }}
           </h2>
           <a href="{{ route('clientes.create') }}" class="text-blue-600 hover:text-blue-900 mr-2">Crear</a>
       </x-slot>

       <div class="py-12">
           <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <div class="p-6 text-gray-900">
                       <div class="flex justify-between items-center mb-4">
                           <h3 class="text-lg font-medium text-gray-900">Lista de Clientes</h3>
                           <a href="{{ route('clientes.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                               Nuevo Cliente
                           </a>
                       </div>

                       @if (session('success'))
                           <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                               <span class="block sm:inline">{{ session('success') }}</span>
                           </div>
                       @endif

                       @if ($clientes->isEmpty())
                           <p>No hay clientes registrados.</p>
                       @else
                
                           <div class="overflow-x-auto">
                               <table class="min-w-full divide-y divide-gray-200">
                                   <thead class="bg-gray-50">
                                       <tr>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                           <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                       </tr>
                                   </thead>
                                   <tbody class="bg-white divide-y divide-gray-200">
                                       @foreach($clientes as $cliente)
                                           <tr>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->id }}</td>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->email }}</td>
                                               <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->telefono }}</td>
                                               <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                   <a href="{{ route('clientes.show', $cliente->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Ver</a>
                                                   <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Editar</a>
                                                   <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                                                       @csrf
                                                       @method('DELETE')
                                                       <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</button>
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
   