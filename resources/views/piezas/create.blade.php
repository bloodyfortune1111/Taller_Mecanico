<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Pieza') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Información de la Pieza</h3>
                        <a href="{{ route('piezas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver al Catálogo
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Ups! Hay algunos problemas:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('piezas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Información básica -->
                            <div class="space-y-4">
                                <h4 class="text-md font-medium text-gray-900 border-b pb-2">Información Básica</h4>
                                
                                <div>
                                    <label for="numero_parte" class="block text-sm font-medium text-gray-700">
                                        Número de Parte *
                                    </label>
                                    <input type="text" name="numero_parte" id="numero_parte" value="{{ old('numero_parte') }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="Ej: P12345">
                                </div>

                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">
                                        Nombre de la Pieza *
                                    </label>
                                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="Ej: Pastillas de freno delanteras">
                                </div>

                                <div>
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                        Descripción
                                    </label>
                                    <textarea name="descripcion" id="descripcion" rows="3"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                              placeholder="Descripción detallada de la pieza...">{{ old('descripcion') }}</textarea>
                                </div>

                                <div>
                                    <label for="categoria" class="block text-sm font-medium text-gray-700">
                                        Categoría *
                                    </label>
                                    <select name="categoria" id="categoria" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Selecciona una categoría</option>
                                        @foreach($categorias as $key => $value)
                                            <option value="{{ $key }}" {{ old('categoria') === $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="marca" class="block text-sm font-medium text-gray-700">
                                        Marca
                                    </label>
                                    <input type="text" name="marca" id="marca" value="{{ old('marca') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="Ej: Bosch, NGK, Ferodo">
                                </div>

                                <div>
                                    <label for="imagen" class="block text-sm font-medium text-gray-700">
                                        Imagen de la Pieza
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                        <div class="space-y-1 text-center">
                                            <div id="image-preview" class="hidden mb-4">
                                                <img id="preview-img" class="mx-auto h-32 w-32 object-cover rounded-lg" src="" alt="Vista previa">
                                            </div>
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="imagen" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Subir imagen</span>
                                                    <input id="imagen" name="imagen" type="file" accept="image/*" class="sr-only" onchange="previewImage(event)">
                                                </label>
                                                <p class="pl-1">o arrastra y suelta</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, JPEG hasta 2MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información comercial -->
                            <div class="space-y-4">
                                <h4 class="text-md font-medium text-gray-900 border-b pb-2">Información Comercial</h4>
                                
                                <div>
                                    <label for="precio" class="block text-sm font-medium text-gray-700">
                                        Precio *
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="precio" id="precio" value="{{ old('precio') }}" required
                                               step="0.01" min="0"
                                               class="pl-7 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                               placeholder="0.00">
                                    </div>
                                </div>

                                <div>
                                    <label for="stock" class="block text-sm font-medium text-gray-700">
                                        Stock Inicial
                                    </label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}"
                                           min="0"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="0">
                                </div>

                                <div>
                                    <label for="disponibilidad" class="block text-sm font-medium text-gray-700">
                                        Disponibilidad *
                                    </label>
                                    <select name="disponibilidad" id="disponibilidad" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="disponible" {{ old('disponibilidad') === 'disponible' ? 'selected' : '' }}>
                                            Disponible
                                        </option>
                                        <option value="agotado" {{ old('disponibilidad') === 'agotado' ? 'selected' : '' }}>
                                            Agotado
                                        </option>
                                        <option value="descontinuado" {{ old('disponibilidad') === 'descontinuado' ? 'selected' : '' }}>
                                            Descontinuado
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <label for="proveedor" class="block text-sm font-medium text-gray-700">
                                        Proveedor
                                    </label>
                                    <input type="text" name="proveedor" id="proveedor" value="{{ old('proveedor') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="Nombre del proveedor">
                                </div>

                                <div>
                                    <label for="vehiculo_compatible" class="block text-sm font-medium text-gray-700">
                                        Vehículos Compatibles
                                    </label>
                                    <textarea name="vehiculo_compatible" id="vehiculo_compatible" rows="3"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                              placeholder="Ej: Toyota Camry 2015-2020, Honda Accord 2016-2021">{{ old('vehiculo_compatible') }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Lista de vehículos compatibles con esta pieza</p>
                                </div>

                                <!-- Estado activo -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="activo" id="activo" value="1" 
                                           {{ old('activo', true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="activo" class="ml-2 block text-sm text-gray-900">
                                        Pieza activa (disponible para uso en órdenes)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Información adicional -->
                        <div class="border-t pt-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Información Adicional</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="imagen_url" class="block text-sm font-medium text-gray-700">
                                        URL de Imagen
                                    </label>
                                    <input type="url" name="imagen_url" id="imagen_url" value="{{ old('imagen_url') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="https://ejemplo.com/imagen.jpg">
                                    <p class="mt-1 text-sm text-gray-500">URL de una imagen de la pieza</p>
                                </div>

                                <div>
                                    <label for="external_id" class="block text-sm font-medium text-gray-700">
                                        ID Externo
                                    </label>
                                    <input type="text" name="external_id" id="external_id" value="{{ old('external_id') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="ID en sistema externo">
                                    <p class="mt-1 text-sm text-gray-500">ID de referencia en sistemas externos (ej: PartsTech)</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="especificaciones" class="block text-sm font-medium text-gray-700">
                                    Especificaciones Técnicas (JSON)
                                </label>
                                <textarea name="especificaciones" id="especificaciones" rows="4"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono text-sm"
                                          placeholder='{"peso": "2.5kg", "material": "cerámico", "garantia": "12 meses"}'>{{ old('especificaciones') }}</textarea>
                                <p class="mt-1 text-sm text-gray-500">Especificaciones en formato JSON (opcional)</p>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex justify-end space-x-3 pt-6 border-t">
                            <a href="{{ route('piezas.index') }}" 
                               class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Crear Pieza
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Vista previa de imagen
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                previewImg.src = '';
            }
        }

        // Validación en tiempo real del JSON de especificaciones
        document.getElementById('especificaciones').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value && value !== '') {
                try {
                    JSON.parse(value);
                    this.classList.remove('border-red-300');
                    this.classList.add('border-green-300');
                } catch (e) {
                    this.classList.remove('border-green-300');
                    this.classList.add('border-red-300');
                    alert('El formato JSON no es válido. Por favor, verifica la sintaxis.');
                }
            } else {
                this.classList.remove('border-red-300', 'border-green-300');
            }
        });

        // Formatear precio mientras se escribe
        document.getElementById('precio').addEventListener('input', function() {
            let value = parseFloat(this.value);
            if (!isNaN(value) && value >= 0) {
                this.classList.remove('border-red-300');
            } else if (this.value !== '') {
                this.classList.add('border-red-300');
            }
        });
    </script>
    @endpush
</x-app-layout>
