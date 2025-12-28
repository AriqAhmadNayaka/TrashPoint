import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite"; // Import plugin

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(), // Tambahkan plugin di sini
    ],
});
