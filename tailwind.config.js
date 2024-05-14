import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                tsaam: {
                    200: "#ffcc63",
                    300: '#FFD89C',
                    400: '#FFBE5B',
                    500: '#faa727', /** default tsaam oranje */
                    600: '#CD7D02',
                    700: '#885300',
                },
            }
        },
    },

    plugins: [forms],
};
