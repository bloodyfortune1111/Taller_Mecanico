<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel de Coches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Fuentes */
        body {
            font-family: 'Inter', sans-serif; /* Fuente Inter para un aspecto moderno */
        }
        /* Estilos para la transición de las imágenes del carrusel */
        .carousel-image {
            transition: opacity 0.5s ease-in-out; /* Transición suave al cambiar de imagen */
        }
        .carousel-image.hidden {
            opacity: 0;
            position: absolute; /* Oculta la imagen y la saca del flujo para que no ocupe espacio */
        }
        .carousel-image.active {
            opacity: 1;
            position: relative; /* Muestra la imagen y la posiciona normalmente */
        }
        /* Estilo para la imagen de fondo del body */
        .body-bg-image {
            background-image: url('https://img.freepik.com/foto-gratis/composicion-moderna-mecanico-automoviles_23-2147881649.jpg?semt=ais_items_boosted&w=740'); /* URL de tu imagen de fondo */
            background-size: cover; /* La imagen cubrirá todo el área */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* La imagen de fondo se mantiene fija al hacer scroll */
        }
    </style>
</head>
<body class="body-bg-image flex flex-col items-center justify-center min-h-screen p-4 relative">
    {{-- Capa de superposición para oscurecer la imagen de fondo y mejorar la legibilidad del texto --}}
    <div class="absolute inset-0 bg-black opacity-50 z-0"></div>

    <div class="w-full max-w-4xl bg-white shadow-xl rounded-lg overflow-hidden border border-blue-200 z-10">
        <div class="relative w-full h-80 sm:h-96 md:h-[400px] lg:h-[500px] overflow-hidden">
            <div id="carousel-images" class="relative w-full h-full">
                <img src="https://media.istockphoto.com/id/1347150429/es/foto/mec%C3%A1nico-profesional-trabajando-en-el-motor-del-coche-en-el-garaje.jpg?s=612x612&w=0&k=20&c=hJdl6vyH7go842-F2-vnyueNQwlOMY-en-oSJOWKfqM=" alt="Coche 1" class="carousel-image active w-full h-full object-cover rounded-lg">
            </div>

            <button id="prevBtn" class="absolute top-1/2 left-4 -translate-y-1/2 bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextBtn" class="absolute top-1/2 right-4 -translate-y-1/2 bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div id="carousel-indicators" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                </div>
        </div>

        <div class="p-6 text-center">
            <h2 class="text-2xl font-bold text-blue-700 mb-2">BIENVENIDO A GEARS MOTORS</h2>
            <p class="text-gray-700">LOS MEJORES DE MEXICO</p>
        </div>
    </div>

    <div class="mt-8 text-center z-10"> {{-- Añadido z-10 para asegurar que los botones estén sobre el overlay --}}
        @auth
            <a href="{{ url('/dashboard') }}" class="inline-block px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:text-lg transition duration-150 ease-in-out shadow-md">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="inline-block px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:text-lg transition duration-150 ease-in-out shadow-md">
                Iniciar Sesión
            </a>
        @endauth
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Array de URLs de imágenes para el carrusel
            const images = [
                "https://media.istockphoto.com/id/1347150429/es/foto/mec%C3%A1nico-profesional-trabajando-en-el-motor-del-coche-en-el-garaje.jpg?s=612x612&w=0&k=20&c=hJdl6vyH7go842-F2-vnyueNQwlOMY-en-oSJOWKfqM=",
                "https://media.istockphoto.com/id/515009943/es/foto/garaje-de-reparaci%C3%B3n-interior-con-mec%C3%A1nico-en-el-fondo.jpg?s=612x612&w=0&k=20&c=JUnOj4yFhzedEJOggYBPT_ciS4P8hF5AtGRue1yUP7s=",
                "https://media.istockphoto.com/id/1554627149/es/foto/los-mec%C3%A1nicos-de-autom%C3%B3viles-son-problemas-de-reparaci%C3%B3n-y-mantenimiento-del-motor-del.jpg?s=612x612&w=0&k=20&c=j0-De4KkDtjIY_e3hmipP7burcaXC9A3WOVOYGXYRHw=",
                "https://media.istockphoto.com/id/1443514461/es/foto/taller-de-reparaci%C3%B3n-de-autom%C3%B3viles-los-coches-abren-el-cap%C3%B3-estacionado-en-el-garaje-para-el.jpg?s=612x612&w=0&k=20&c=g_GAL8fnSbd3ZdPRoj2ATfM6-maHtET3vICeuEzAgUE=",
                "https://media.istockphoto.com/id/1438376535/es/foto/hermoso-trabajo-mec%C3%A1nico-en-uniforme-trabajando-en-coche.jpg?s=612x612&w=0&k=20&c=nrDWbToWgP7B2b0xPUi9eXrmzVAZyVwToSW1A1JGlo8="
            ];
            let currentImageIndex = 0;
            const carouselImagesContainer = document.getElementById('carousel-images');
            const indicatorsContainer = document.getElementById('carousel-indicators');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let intervalId;

            function showImage(index) {
                carouselImagesContainer.innerHTML = '';
                const img = document.createElement('img');
                img.src = images[index];
                img.alt = `Coche ${index + 1}`;
                img.className = 'carousel-image active w-full h-full object-cover rounded-lg';
                carouselImagesContainer.appendChild(img);
                updateIndicators(index);
            }

            function updateIndicators(activeIndex) {
                indicatorsContainer.innerHTML = '';
                images.forEach((_, index) => {
                    const dot = document.createElement('span');
                    dot.classList.add('w-3', 'h-3', 'rounded-full', 'bg-gray-300', 'cursor-pointer', 'transition', 'duration-300');
                    if (index === activeIndex) {
                        dot.classList.remove('bg-gray-300');
                        dot.classList.add('bg-blue-500');
                    }
                    dot.addEventListener('click', () => {
                        currentImageIndex = index;
                        showImage(currentImageIndex);
                        resetInterval();
                    });
                    indicatorsContainer.appendChild(dot);
                });
            }

            function nextImage() {
                currentImageIndex = (currentImageIndex + 1) % images.length;
                showImage(currentImageIndex);
            }

            function prevImage() {
                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                showImage(currentImageIndex);
            }

            function resetInterval() {
                clearInterval(intervalId);
                intervalId = setInterval(nextImage, 3000);
            }

            nextBtn.addEventListener('click', () => {
                nextImage();
                resetInterval();
            });

            prevBtn.addEventListener('click', () => {
                prevImage();
                resetInterval();
            });

            showImage(currentImageIndex);
            resetInterval();
        });
    </script>
</body>
</html>