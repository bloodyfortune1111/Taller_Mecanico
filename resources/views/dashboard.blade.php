<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-primary-900 leading-tight">
                {{ __('GearsMotors Mexico') }}
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">{{ now()->format('d/m/Y') }}</span>
                <div class="badge badge-primary">
                    Sistema Activo
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Estadísticas Dashboard -->
            <div class="dashboard-stats fade-in">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Clientes Activos</div>
                    <div class="stat-value">{{ \App\Models\Cliente::count() }}</div>
                    <div class="stat-change positive">+12% este mes</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Órdenes Activas</div>
                    <div class="stat-value">{{ \App\Models\OrdenServicio::where('estado', 'pendiente')->count() }}</div>
                    <div class="stat-change positive">+8% esta semana</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Vehículos</div>
                    <div class="stat-value">{{ \App\Models\Vehiculo::count() }}</div>
                    <div class="stat-change positive">+15% este mes</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Piezas</div>
                    <div class="stat-value">{{ \App\Models\Pieza::count() }}</div>
                    <div class="stat-change positive">+5% esta semana</div>
                </div>
            </div>

            <!-- Tarjeta principal con carrusel -->
            <div class="card slide-in">
                <div class="card-header">
                    <h3 class="card-title">¡Bienvenido a GearsMotors Mexico!</h3>
                    <p class="card-subtitle">Tu sistema integral de gestión para talleres mecánicos</p>
                </div>
                <div class="card-body">
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
                    class="relative w-full max-w-4xl mx-auto rounded-xl overflow-hidden shadow-primary mb-8"
                    style="height: 400px;"
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
                                        :class="{ 'bg-primary-600': currentIndex === index, 'bg-gray-400': currentIndex !== index }"
                                        class="w-3 h-3 rounded-full focus:outline-none transition-all duration-300 hover:scale-110"></button>
                            </template>
                        </div>
                    </div>
                    
                    <!-- Acciones rápidas -->
                    <div class="mt-8 text-center">
                        <h4 class="font-bold text-xl text-primary-900 mb-6">Acciones Rápidas</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Nuevo Cliente
                            </a>
                            @endif
                            @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                            <a href="{{ route('vehiculos.create') }}" class="btn btn-success">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Nuevo Vehículo
                            </a>
                            <a href="{{ route('ordenes-servicio.create') }}" class="btn btn-warning">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Nueva Orden
                            </a>
                            @endif
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('servicios.create') }}" class="btn btn-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Nuevo Servicio
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>