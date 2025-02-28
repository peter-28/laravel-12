import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "table-header": "#f3f4f6", // Warna latar belakang header tabel
                "table-cell": "#ffffff", // Warna latar belakang cell
                "table-border": "#e5e7eb", // Warna border tabel
            },
            spacing: {
                "table-padding": "1rem", // Padding untuk sel tabel
            },
        },
    },

    plugins: [forms],
};
