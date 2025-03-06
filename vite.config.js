import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/*.js',
                'resources/js/**/*.js',
                'resources/scss/*.scss',
                'resources/scss/**/*.scss'
            ],
            refresh: true,
        }),
    ],
});
