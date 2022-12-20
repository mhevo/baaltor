import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/bootstrap.css',
                'resources/css/bootstrap-nightfall.css',
                'resources/js/app.js',
                'resources/js/jquery-3.6.2.min.js',
                'resources/js/bootstrap.min.js',
            ],
            refresh: true,
        }),
    ],
});