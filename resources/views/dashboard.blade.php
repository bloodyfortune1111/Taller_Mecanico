<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GearsMotors Mexico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-center">¡Bienvenido a GearsMotors !</h3>

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
                            }, 4000); // Cambia cada 4 segundos
                        },
                        stopCarousel() {
                            clearInterval(this.intervalId);
                        }
                    }"
                    x-init="startCarousel()"
                    x-on:mouseover="stopCarousel()"
                    x-on:mouseleave="startCarousel()"
                    class="relative w-full max-w-4xl mx-auto rounded-lg overflow-hidden shadow-lg mb-8"
                    style="height: 400px;" {{-- Ajusta la altura según tus imágenes --}}
                    >
                        <template x-for="(image, index) in images" :key="index">
                            <img :src="image"
                                :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }"
                                class="absolute top-0 left-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out"
                                alt="Imagen de Taller Mecánico">
                        </template>

                        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                            <template x-for="(image, index) in images" :key="index">
                                <button @click="currentIndex = index"
                                        :class="{ 'bg-blue-600': currentIndex === index, 'bg-gray-400': currentIndex !== index }"
                                        class="w-3 h-3 rounded-full focus:outline-none"></button>
                            </template>
                        </div>
                    </div>
                    <div class="mt-8 text-center px-4">
                        <p class="text-lg text-gray-700 leading-relaxed mb-4">
                            Este sistema ha sido diseñado para optimizar la gestión de tu taller mecánico, permitiéndote
                            centralizar la información de clientes y vehículos, así como llevar un control riguroso de
                            cada orden de servicio. Digitaliza tus operaciones y despídete de la pérdida de datos y la
                            ineficiencia del papel.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Desde el registro detallado de ingresos y egresos hasta la asignación de mecánicos y la
                            generación de reportes automáticos, nuestra plataforma te brinda las herramientas necesarias
                            para mejorar la trazabilidad, la eficiencia y, en última instancia, la rentabilidad de tu negocio.
                            ¡Explora las funcionalidades y lleva tu taller al siguiente nivel!
                        </p>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>