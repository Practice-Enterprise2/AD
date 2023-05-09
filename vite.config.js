import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/layouts/app.css',
                'resources/css/layouts/public.css',
                'resources/css/layouts/guest.css',
                'resources/css/layouts/control-panel.css',
                'resources/css/main.css',
                'resources/js/app.js',
                'resources/css/control_panel/main.css',
            ],
            refresh: true,
        }),
    ],
});
