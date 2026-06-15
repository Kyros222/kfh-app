import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/style.css',
                'resources/css/contact.css',
                'resources/js/contact.js',
                'resources/css/services.css',
                'resources/css/about.css',
                'resources/css/blog.css',
                'resources/css/post.css',
                'resources/css/privacy.css',
                'resources/js/preloader.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
