import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/editor/css/simditor.css',
                'resources/js/app.js',
                'resources/editor/js/module.js',
                'resources/editor/js/hotkeys.js',
                'resources/editor/js/uploader.js',
                'resources/editor/js/simditor.js',
            ],
            refresh: true,
        }),
    ],
});
