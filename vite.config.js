import babel from '@rollup/plugin-babel';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            plugins: [
                babel({
                    babelHelpers: 'bundled',
                    exclude: 'node_modules/**',
                    extensions: ['.js'],
                    include: ['resources/js/**'],
                }),
            ],
        },
    },
});
