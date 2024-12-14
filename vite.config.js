import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import mkcert from "vite-plugin-mkcert";

export default defineConfig({
    server: {
        https: true,
        host: "tictic-fp.id",
    },
    plugins: [
        mkcert(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: ["resources/routes/**", "routes/**", "resources/views/**"],
        }),
    ],
});
