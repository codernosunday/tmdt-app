import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import glob from 'glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...glob.sync('resources/**/*.js'),
                ...glob.sync('resources/**/*.scss'),
            ],
            refresh: true,
        }),
    ],
});
