/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ["Poppins", "sans-serif"],
            quicksand: ["Quicksand", "sans-serif"],
        },
        extend: {},
    },
    darkMode: "class",
    plugins: [require("@tailwindcss/forms")],
};
