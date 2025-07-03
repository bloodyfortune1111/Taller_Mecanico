<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Sistema de Gestión para Talleres</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- CSS personalizado para el taller -->
        <link href="{{ asset('css/taller-custom.css') }}" rel="stylesheet">
        
        <!-- Meta tags adicionales -->
        <meta name="description" content="Sistema integral de gestión para talleres mecánicos - GearsMotors Mexico">
        <meta name="keywords" content="taller mecánico, gestión, vehículos, servicios, piezas">
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="fade-in">
                {{ $slot }}
            </main>
        </div>
        
        <!-- Scripts adicionales -->
        <script>
            // Animaciones suaves al cargar la página
            document.addEventListener('DOMContentLoaded', function() {
                // Agregar animación fade-in a elementos
                const elements = document.querySelectorAll('.fade-in');
                elements.forEach((el, index) => {
                    el.style.animationDelay = `${index * 0.1}s`;
                });
                
                // Mejorar la experiencia de hover en tarjetas
                const cards = document.querySelectorAll('.card-hover');
                cards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-8px) scale(1.02)';
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0) scale(1)';
                    });
                });
            });
        </script>
    </body>
</html>
