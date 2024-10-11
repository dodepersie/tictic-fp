/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ["Jost", "sans-serif"],
            afacadflux: ["Afacad Flux", "sans-serif"],
        },
        extend: {},
    },
    darkMode: "class",
    plugins: [require("@tailwindcss/forms")],
};
