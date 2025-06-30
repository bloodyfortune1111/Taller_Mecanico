import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // Asegúrate de que NO haya una sección 'server' aquí.
    // Si la tenías, elimínala o comenta toda la sección:
    /*
    server: {
        proxy: {
            '/': 'http://localhost:8000',
        },
        host: 'localhost',
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    }
    */
});