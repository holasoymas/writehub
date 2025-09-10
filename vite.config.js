import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

const frontendFiles = [
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/js/createPost.js',
    'resources/js/renderPost.js',
    'resources/js/renderComment.js',
    'resources/js/likes.js',
    'resources/js/bookmark.js',
    'resources/js/dropdown.js',
    'resources/js/followers.js',
    'resources/js/error-box.js',
]

export default defineConfig({
    plugins: [
        laravel({
            input: frontendFiles,
            refresh: true,
        }),
        tailwindcss(),
    ],
});
