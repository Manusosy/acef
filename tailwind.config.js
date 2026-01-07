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
                'acef-green': '#13a759', // Bright Green (Primary/Action)
                'acef-gold': '#f1cd40',  // Gold (Accent)
                'acef-dark': '#0b3d32',  // Deep Forest Green (Backgrounds)
                'acef-deep-green': '#235046', // Partners CTA Green
                'acef-light-green': '#8dba8e', // Lighter Green (Timeline Bg)
                'acef-gray': '#F9FAFB',
                'acef-body': 'rgb(50, 44, 42)',
            }
        },
    },

    plugins: [forms, require('@tailwindcss/typography')],
};
