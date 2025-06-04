import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss', // Asegúrate de que apunte a tu archivo SCSS
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
