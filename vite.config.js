import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
<<<<<<< HEAD
            input: ['resources/js/app.js', 'resources/scss/app.scss'],
=======
            input: [
                'resources/js/*.js',
                'resources/js/**/*.js',
                'resources/scss/*.scss',
                'resources/scss/**/*.scss',
                'resources/css/**/*.css',
                'resources/css/*.css'
            ],
>>>>>>> Tin
            refresh: true,
        }),
    ],
});
