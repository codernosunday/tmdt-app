import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { globSync } from 'glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...globSync('resources/**/*.js'),
                ...globSync('resources/**/*.scss'),
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias:{
            '@img': '/resources/img',
        }
    }
});
