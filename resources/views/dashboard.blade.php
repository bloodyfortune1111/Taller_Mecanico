<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 text-white rounded-xl shadow-lg p-6 mx-6">
            <h2 class="font-bold text-3xl leading-tight flex items-center">
                <svg class="w-10 h-10 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                {{ __('GearsMotors Mexico') }}
            </h2>
            <p class="text-blue-100 mt-2 text-lg">Sistema integral de gestión para talleres mecánicos</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Panel de bienvenida principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl mb-8 border border-gray-100">
                <div class="p-8 text-gray-900">
                    <div class="text-center mb-8">
                        <h3 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                            ¡Bienvenido a GearsMotors!
                        </h3>
                        <p class="text-xl text-gray-600">Tu socio tecnológico para la gestión del taller mecánico</p>
                    </div>

                    <!-- Carrusel de imágenes mejorado -->
                    <div x-data="{
                        images: [
                            '{{ asset('images/taller1.jpg') }}',
                            '{{ asset('images/taller2.jpg') }}',
                            '{{ asset('images/taller3.jpg') }}',
                            '{{ asset('images/taller4.jpg') }}'
                        ],
                        currentIndex: 0,
                        intervalId: null,
                        startCarousel() {
                            this.intervalId = setInterval(() => {
                                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                            }, 4000);
                        },
                        stopCarousel() {
                            clearInterval(this.intervalId);
                        }
                    }"
                    x-init="startCarousel()"
                    x-on:mouseover="stopCarousel()"
                    x-on:mouseleave="startCarousel()"
                    class="relative w-full max-w-5xl mx-auto rounded-2xl overflow-hidden shadow-2xl mb-12 border-4 border-gradient-to-r from-blue-200 to-purple-200"
                    style="height: 450px;">
                        <template x-for="(image, index) in images" :key="index">
                            <img :src="image"
                                :class="{ 'opacity-100 scale-100': currentIndex === index, 'opacity-0 scale-105': currentIndex !== index }"
                                class="absolute top-0 left-0 w-full h-full object-cover transition-all duration-1000 ease-in-out"
                                alt="Imagen de Taller Mecánico">
                        </template>

                        <!-- Overlay con gradiente -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>

                        <!-- Controles del carrusel -->
                        <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-3">
                            <template x-for="(image, index) in images" :key="index">
                                <button @click="currentIndex = index"
                                        :class="{ 'bg-white scale-110': currentIndex === index, 'bg-white/50': currentIndex !== index }"
                                        class="w-4 h-4 rounded-full focus:outline-none transition-all duration-300 hover:scale-110 shadow-lg"></button>
                            </template>
                        </div>

                        <!-- Navegación con flechas -->
                        <button @click="currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-200 hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="currentIndex = (currentIndex + 1) % images.length"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-200 hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Descripción mejorada -->
                    <div class="grid md:grid-cols-2 gap-8 mt-12">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                            <div class="flex items-start mb-4">
                                <div class="bg-blue-600 p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-blue-900 mb-2">Gestión Centralizada</h4>
                                    <p class="text-blue-800 leading-relaxed">
                                        Optimiza la gestión de tu taller mecánico centralizando la información de clientes, vehículos 
                                        y órdenes de servicio. Digitaliza tus operaciones y despídete de la pérdida de datos.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
                            <div class="flex items-start mb-4">
                                <div class="bg-purple-600 p-3 rounded-lg mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-purple-900 mb-2">Eficiencia y Control</h4>
                                    <p class="text-purple-800 leading-relaxed">
                                        Desde el control de ingresos y egresos hasta la asignación de mecánicos y generación 
                                        de reportes automáticos. Mejora la trazabilidad y rentabilidad de tu negocio.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Call to action -->
                    <div class="text-center mt-12">
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-8 border border-gray-200">
                            <h4 class="text-2xl font-bold text-gray-900 mb-4">¡Explora las funcionalidades!</h4>
                            <p class="text-gray-700 text-lg mb-6">
                                Lleva tu taller al siguiente nivel con nuestras herramientas especializadas
                            </p>
                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="{{ route('clientes.index') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Gestionar Clientes
                                </a>
                                <a href="{{ route('servicios.index') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                                    </svg>
                                    Ver Servicios
                                </a>
                                <a href="{{ route('piezas.index') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                                    </svg>
                                    Catálogo de Piezas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>