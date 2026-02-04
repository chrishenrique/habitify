import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        cors: true, // Resolve o erro de CORS
        hmr: {
            host: 'habitify.local',
            path: 'vite-hmr',
            clientPort: 443,
            protocol: 'wss', // Força o WebSocket a ser seguro
        },
        watch: {
            usePolling: true,
            ignored: ['**/storage/framework/views/**'],
        },
    },
});