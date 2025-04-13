import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import filament from "./vendor/filament/support/plugin.js";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/filament/company/theme.css",
            ],
            refresh: true,
        }),
        filament(),
    ],
});
