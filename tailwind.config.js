const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#570DF8",
                secondary: "#F000B8",
                accent: "#37CDBE",
                neutral: "#3D4451",
                "base-100": "#FFFFFF",
                info: "#3ABFF8",
                success: "#36D399",
                warning: "#FBBD23",
                error: "#F87272",
                accent: "#806043",
                neutral: "#3D4451",
                "base-100": "#FFFFFF",
            },
            // font weights
            fontWeight: {
                thin: 100,
                light: 300,
                normal: 400,
                medium: 500,
                semibold: 600,
                bold: 700,
                extrabold: 800,
                black: 900,
            },
        },
    },
    plugins: [
        require("flowbite/plugin")({
            charts: true,
        }),
    ],
};
