const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        minHeight: {
            ...defaultTheme.minHeight,
            'screen-95': '95vh'
        },
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ...defaultTheme.colors,
                'dark-blue': '#232A3B',
                dark: {
                    1: "#293145",
                    2: "#232a3b",
                    3: "#313a55",
                    4: "#1e2533",
                    5: "#3f4865",
                    6: "#2b3348",
                    7: "#181f29",
                },
            },
            spacing: {
                ...defaultTheme.spacing,
                '230px': '230px'
            },
        },
        borderRadius: {
            ...defaultTheme.borderRadius,
            '30px': '30px',
        },
    },

    variants: {
        extend: {
            backgroundColor: ['checked', 'disabled'],
            cursor: ['disabled'],
            borderColor: ['checked', 'disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
