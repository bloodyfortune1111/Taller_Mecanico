   <x-app-layout>
       <x-slot name="header">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Detalles del Vehículo') }}
           </h2>
       </x-slot>

       <div class="py-12">
           <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <div class="p-6 text-gray-900">
                       <h3 class="text-lg font-medium text-gray-900 mb-4">Detalles del Vehículo: {{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h3>

                       <div class="border-t border-gray-200 pt-4">
                           <dl class="divide-y divide-gray-200">
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">ID</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->id }}</dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Marca</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->marca }}</dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Modelo</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->modelo }}</dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Año</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->ano }}</dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Matrícula</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->matricula }}</dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Color</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->color }}</dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Cliente Asociado</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                       @if($vehiculo->cliente)
                                           <a href="{{ route('clientes.show', $vehiculo->cliente->id) }}" class="text-blue-600 hover:underline">
                                               {{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellido }}
                                           </a>
                                       @else
                                           N/A
                                       @endif
                                   </dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Fecha de Creación</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->created_at->format('d/m/Y H:i') }}</dd>
                               </div>
                               <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                   <dt class="text-sm font-medium leading-6 text-gray-900">Última Actualización</dt>
                                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $vehiculo->updated_at->format('d/m/Y H:i') }}</dd>
                               </div>
                           </dl>
                       </div>

                       <div class="mt-6 flex items-center justify-end gap-x-6">
                           <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                               Editar Vehículo
                           </a>
                           <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="inline">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                   Eliminar Vehículo
                               </button>
                           </form>
                           <a href="{{ route('vehiculos.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                               Volver a la Lista
                           </a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </x-app-layout>