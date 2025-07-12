<x-app-layout>
       <x-slot name="header">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Crear Vehículo') }}
           </h2>
       </x-slot>

       <div class="py-12">
           <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <div class="p-6 text-gray-900">
                       <h3 class="text-lg font-medium text-gray-900 mb-4">Nuevo Vehículo</h3>

                       @if ($errors->any())
                           <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                               <ul class="list-disc list-inside">
                                   @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif

                       <form action="{{ route('vehiculos.store') }}" method="POST">
                           @csrf

                           <div class="mb-4">
                               <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente:</label>
                               <select name="cliente_id" id="cliente_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                   <option value="">Selecciona un cliente</option>
                                   @foreach($clientes as $cliente)
                                       <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                           {{ $cliente->nombre }} {{ $cliente->apellido }} ({{ $cliente->email }})
                                       </option>
                                   @endforeach
                               </select>
                               @error('cliente_id')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="marca" class="block text-sm font-medium text-gray-700">Marca:</label>
                               <input type="text" name="marca" id="marca" value="{{ old('marca') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('marca')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo:</label>
                               <input type="text" name="modelo" id="modelo" value="{{ old('modelo') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('modelo')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="año" class="block text-sm font-medium text-gray-700">Año:</label>
                               <input type="number" name="año" id="año" value="{{ old('año') }}" min="1900" max="{{ date('Y') + 1 }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('año')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="matricula" class="block text-sm font-medium text-gray-700">Matrícula:</label>
                               <input type="text" name="matricula" id="matricula" value="{{ old('matricula') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('matricula')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="color" class="block text-sm font-medium text-gray-700">Color:</label>
                               <input type="text" name="color" id="color" value="{{ old('color') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('color')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="combustible" class="block text-sm font-medium text-gray-700">Tipo de Combustible:</label>
                               <select name="combustible" id="combustible" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                   <option value="">Selecciona un tipo</option>
                                   <option value="gasolina" {{ old('combustible') == 'gasolina' ? 'selected' : '' }}>Gasolina</option>
                                   <option value="diesel" {{ old('combustible') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                   <option value="hibrido" {{ old('combustible') == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                                   <option value="electrico" {{ old('combustible') == 'electrico' ? 'selected' : '' }}>Eléctrico</option>
                                   <option value="gas" {{ old('combustible') == 'gas' ? 'selected' : '' }}>Gas</option>
                               </select>
                               @error('combustible')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="kilometraje" class="block text-sm font-medium text-gray-700">Kilometraje:</label>
                               <input type="number" name="kilometraje" id="kilometraje" value="{{ old('kilometraje') }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                               @error('kilometraje')
                                   <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                               @enderror
                           </div>

                           <div class="flex items-center justify-end mt-4">
                               <a href="{{ route('vehiculos.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                               <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                   Guardar Vehículo
                               </button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </x-app-layout>
   