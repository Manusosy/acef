import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Source Sans 3"', ...defaultTheme.fontFamily.sans],
                serif: ['"Crimson Pro"', ...defaultTheme.fontFamily.serif],
                heading: ['"Crimson Pro"', ...defaultTheme.fontFamily.serif],
            },
            fontSize: {
                base: ['18px', { lineHeight: '29px' }],
            },
            colors: {
                'acef-green': '#28D160',
                'acef-dark': '#011F0B',
                'acef-gray': '#F9FAFB',
                'acef-body': 'rgb(50, 44, 42)',
            }
        },
    },

    plugins: [forms, require('@tailwindcss/typography')],
};
