import { defineConfig } from "vite";
import path from "path";

export default defineConfig({
    build: {
        outDir: './public/build/',
        manifest: true,
        rollupOptions: {
            input: [
                './js/main.js',
            ]
        },
    },

    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
    }
})
