   <x-app-layout>
       <x-slot name="header">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Editar Cliente') }}
           </h2>
       </x-slot>

       <div class="py-12">
           <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <div class="p-6 text-gray-900">
                       <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Cliente: {{ $cliente->nombre }} {{ $cliente->apellido }}</h3>

                       @if ($errors->any())
                           <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                               <ul class="list-disc list-inside">
                                   @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif

                       <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                           @csrf
                           @method('PUT') {{-- Importante para indicar que es una solicitud PUT para la actualización --}}

                           <div class="mb-4">
                               <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                               <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('nombre')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                               <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $cliente->apellido) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('apellido')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                               <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('email')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                               <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('telefono')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección:</label>
                               <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('direccion')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="flex items-center justify-end mt-4">
                               <a href="{{ route('clientes.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                               <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                   Actualizar Cliente
                               </button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </x-app-layout>