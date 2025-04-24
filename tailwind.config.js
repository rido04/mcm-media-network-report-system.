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
                "mcm-purple": "#bdafee", // Purple Color
                "mcm-dark": "#0F1419", // Dark Color
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
    darkMode: "class",
};
