<nav x-data="{ open: false }" class="navbar-container">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="logo-container group">
                        <div class="logo-icon group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="logo-text">GearsMotors</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Dashboard - Diferente según el rol --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                            <span>{{ __('Dashboard Admin') }}</span>
                        </x-nav-link>
                    @elseif(auth()->user()->role === 'recepcionista')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                            <span>{{ __('Panel Recepción') }}</span>
                        </x-nav-link>
                    @endif

                    {{-- Clientes - Solo admin --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.*')"
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>{{ __('Clientes') }}</span>
                        </x-nav-link>
                    @endif

                    {{-- Vehículos - Admin y Recepcionista --}}
                    @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                        <x-nav-link :href="route('vehiculos.index')" :active="request()->routeIs('vehiculos.*')"
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                            </svg>
                            <span>{{ __('Vehículos') }}</span>
                        </x-nav-link>
                    @endif

                    {{-- Órdenes de Servicio - Admin, Mecánico y Recepcionista --}}
                    @if(in_array(auth()->user()->role, ['admin', 'recepcionista', 'mecanico']))
                        @php
                            $ordenesRoute = match(auth()->user()->role) {
                                'admin' => 'ordenes-servicio.index',
                                'recepcionista' => 'recepcionista.ordenes.index',
                                'mecanico' => 'mecanico.ordenes.index',
                                default => 'ordenes-servicio.index'
                            };
                        @endphp
                        <x-nav-link :href="route($ordenesRoute)" :active="request()->routeIs(['ordenes-servicio.*', 'recepcionista.ordenes.*', 'mecanico.ordenes.*'])"
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs(['ordenes-servicio.*', 'recepcionista.ordenes.*', 'mecanico.ordenes.*']) ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>{{ __('Órdenes') }}</span>
                        </x-nav-link>
                    @endif

                    {{-- Servicios - Admin y Recepcionista (solo lectura para recepcionista) --}}
                    @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                        <x-nav-link :href="route('servicios.index')" :active="request()->routeIs('servicios.*')"
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('servicios.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                            </svg>
                            <span>{{ __('Servicios') }}</span>
                        </x-nav-link>
                    @endif

                    {{-- Piezas - Admin y Recepcionista (solo lectura para recepcionista) --}}
                    @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                        <x-nav-link :href="route('piezas.index')" :active="request()->routeIs('piezas.*')"
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('piezas.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>{{ __('Piezas') }}</span>
                        </x-nav-link>
                    @endif

                    {{-- Facturas - Admin y Recepcionista --}}
                    @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                        <x-nav-link :href="route('recepcionista.facturas.index')" :active="request()->routeIs('recepcionista.facturas.*')"
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('recepcionista.facturas.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>{{ __('Facturas') }}</span>
                        </x-nav-link>
                    @endif

                    {{-- Reportes - Admin y Recepcionista --}}
                    @if(in_array(auth()->user()->role, ['admin', 'recepcionista']))
                        <x-nav-link :href="route('reportes.index')" :active="request()->routeIs('reportes.*')"
                                    class="flex items-center space-x-2 px-3 py-2 nav-item {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>{{ __('Reportes') }}</span>
                        </x-nav-link>
                    @endif
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="dropdown-user-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-white">{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-white transition-transform duration-300 dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="profile-dropdown-header">
                            <div class="user-info">
                                <div class="user-avatar-large">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                    <div class="user-email">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <x-dropdown-link :href="route('dashboard')" class="dropdown-item">
                            <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                            {{ __('Dashboard') }}
                        </x-dropdown-link>

                        <a href="{{ route('profile.edit') }}" class="dropdown-item" onclick="window.location.href='{{ route('profile.edit') }}'; return false;">
                            <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('Mi Perfil') }}
                        </a>

                        <x-dropdown-link :href="route('clientes.index')" class="dropdown-item">
                            <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ __('Clientes') }}
                        </x-dropdown-link>

                        @php
                            $ordenesRouteDropdown = match(auth()->user()->role) {
                                'admin' => 'ordenes-servicio.index',
                                'recepcionista' => 'recepcionista.ordenes.index',
                                'mecanico' => 'mecanico.ordenes.index',
                                default => 'ordenes-servicio.index'
                            };
                        @endphp
                        <x-dropdown-link :href="route($ordenesRouteDropdown)" class="dropdown-item">
                            <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            {{ __('Órdenes de Servicio') }}
                        </x-dropdown-link>

                        <div class="dropdown-divider"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="dropdown-item logout-item"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-200 hover:text-white hover:bg-gray-700 hover:bg-opacity-50 focus:outline-none focus:bg-gray-700 focus:bg-opacity-50 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800 bg-opacity-50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.*')">
                {{ __('Clientes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('vehiculos.index')" :active="request()->routeIs('vehiculos.*')">
                {{ __('Vehículos') }}
            </x-responsive-nav-link>
            @php
                $ordenesRouteMobile = match(auth()->user()->role) {
                    'admin' => 'ordenes-servicio.index',
                    'recepcionista' => 'recepcionista.ordenes.index',
                    'mecanico' => 'mecanico.ordenes.index',
                    default => 'ordenes-servicio.index'
                };
            @endphp
            <x-responsive-nav-link :href="route($ordenesRouteMobile)" :active="request()->routeIs(['ordenes-servicio.*', 'recepcionista.ordenes.*', 'mecanico.ordenes.*'])">
                {{ __('Órdenes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('servicios.index')" :active="request()->routeIs('servicios.*')">
                {{ __('Servicios') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('piezas.index')" :active="request()->routeIs('piezas.*')">
                {{ __('Piezas') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
