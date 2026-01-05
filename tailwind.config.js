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
                'acef-green': '#134712', // Deep Green (Primary)
                'acef-gold': '#f1cd40',  // Gold (Accent)
                'acef-dark': '#0A260A',  // Darker Green (Contrast/Hover)
                'acef-light-green': '#8dba8e', // Lighter Green (Timeline Bg)
                'acef-gray': '#F9FAFB',
                'acef-body': 'rgb(50, 44, 42)',
            }
        },
    },

    plugins: [forms, require('@tailwindcss/typography')],
};
