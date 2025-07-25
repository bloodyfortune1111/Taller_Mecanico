<x-app-layout>
       <x-slot name="header">
           <div class="flex items-center justify-between">
               <div class="flex items-center gap-4">
                   <div class="p-3 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl">
                       <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                       </svg>
                   </div>
                   <div>
                       <h2 class="text-2xl font-bold text-gray-900">
                           {{ __('Gestión de Vehículos') }}
                       </h2>
                       <p class="text-gray-600">Administra la flota de vehículos del taller</p>
                   </div>
               </div>
           </div>
       </x-slot>

       <div class="py-8">
           <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="card fade-in">
                   <div class="card-header">
                       <div class="flex justify-between items-center">
                           <div>
                               <h3 class="card-title">Lista de Vehículos</h3>
                               <p class="card-subtitle">Gestiona todos los vehículos registrados</p>
                           </div>
                           @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                           <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">
                               <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                               </svg>
                               Nuevo Vehículo
                           </a>
                           @endif
                       </div>
                   </div>
                   <div class="card-body">

                       @if (session('success'))
                           <div class="alert alert-success scale-in">
                               <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                               </svg>
                               {{ session('success') }}
                           </div>
                       @endif

                       @if ($vehiculos->isEmpty())
                           <div class="text-center py-12">
                               <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                               </svg>
                               <h3 class="text-lg font-medium text-gray-900 mb-2">No hay vehículos registrados</h3>
                               <p class="text-gray-600 mb-6">
                                   @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                                       Comienza agregando el primer vehículo al sistema
                                   @else
                                       No hay vehículos registrados en el sistema
                                   @endif
                               </p>
                               @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                               <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">
                                   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                   </svg>
                                   Agregar Vehículo
                               </a>
                               @endif
                           </div>
                       @else
                           <div class="table-container">
                               <table class="table">
                                   <thead class="table-header">
                                       <tr>
                                           <th>ID</th>
                                           <th>Marca</th>
                                           <th>Modelo</th>
                                           <th>Matrícula</th>
                                           <th>Cliente</th>
                                           <th>Acciones</th>
                                       </tr>
                                   </thead>
                                   <tbody class="table-body">
                                       @foreach($vehiculos as $vehiculo)
                                           <tr>
                                               <td>
                                                   <div class="flex items-center">
                                                       <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                                           {{ $vehiculo->id }}
                                                       </div>
                                                   </div>
                                               </td>
                                               <td>
                                                   <div class="font-medium text-gray-900">{{ $vehiculo->marca }}</div>
                                               </td>
                                               <td>
                                                   <div class="font-medium text-gray-900">{{ $vehiculo->modelo }}</div>
                                               </td>
                                               <td>
                                                   <div class="badge badge-primary">{{ $vehiculo->matricula }}</div>
                                               </td>
                                               <td>
                                                   @if($vehiculo->cliente)
                                                       <div class="flex items-center gap-2">
                                                           <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                               {{ substr($vehiculo->cliente->nombre, 0, 1) }}{{ substr($vehiculo->cliente->apellido, 0, 1) }}
                                                           </div>
                                                           <div>
                                                               <div class="font-medium text-gray-900">{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellido }}</div>
                                                           </div>
                                                       </div>
                                                   @else
                                                       <span class="badge badge-warning">N/A</span>
                                                   @endif
                                               </td>
                                               <td>
                                                   <div class="flex items-center gap-2">
                                                       <a href="{{ route('vehiculos.show', $vehiculo->id) }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 0.75rem;">
                                                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                           </svg>
                                                       </a>
                                                       @if(auth()->user()->role === 'admin')
                                                       <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning" style="padding: 8px 12px; font-size: 0.75rem;">
                                                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                           </svg>
                                                       </a>
                                                       <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="inline">
                                                           @csrf
                                                           @method('DELETE')
                                                           <button type="submit" class="btn btn-danger" style="padding: 8px 12px; font-size: 0.75rem;" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                                               <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                               </svg>
                                                           </button>
                                                       </form>
                                                       @endif
                                                   </div>
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
               class="modal-overlay"
               x-cloak
           >
               <div class="modal-content">
                   <div class="modal-header">
                       <h2 class="text-xl font-bold text-gray-900">¿Registrar un vehículo?</h2>
                   </div>
                   <div class="modal-body">
                       <p class="text-gray-600">¿Deseas registrar un vehículo para este cliente ahora?</p>
                   </div>
                   <div class="modal-footer">
                       <button 
                           class="btn btn-secondary"
                           x-on:click="open = false"
                       >No, gracias</button>
                       @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                       <a 
                           href="{{ route('vehiculos.create') }}"
                           class="btn btn-success"
                       >Sí, registrar auto</a>
                       @endif
                   </div>
               </div>
           </div>
       @endif
   </x-app-layout>