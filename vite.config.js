import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                /** Estilos globales */
                'resources/sass/app.scss',
                'resources/css/app.css', 
                'resources/js/app.js',
                
                /** Estilos para los pdfs */
                'resources/css/pdf.css',
                'resources/js/pdf.js',
            ],
            refresh: true,
        }),
    ],
});
