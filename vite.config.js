import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/*.js',
                'resources/js/**/*.js',
                'resources/scss/*.scss',
                'resources/scss/**/*.scss',
                'resources/css/**/*.css',
                'resources/css/*.css'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@img': '/resources/img',
        }
    }
});
