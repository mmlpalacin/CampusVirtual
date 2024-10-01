import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/form.css',
                'resources/js/form.js',
                'resources/js/padres.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
