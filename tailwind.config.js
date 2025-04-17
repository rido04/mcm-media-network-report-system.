/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./app/Filament/**/*.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                "mcm-purple": "#bdafee", // Warna ungu dari screenshot Anda
                "mcm-dark": "#0F1419", // Warna dark
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
    darkMode: "class",
};
