const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            cyan: colors.cyan,
            green: colors.green,
            black: colors.black,
            white: colors.white,
            red: colors.red,
            yellow: colors.amber,
            blue: colors.blue,
            gray: colors.blueGray,
            indigo: colors.indigo,
            sky: colors.sky,
        },
        
        borderWidth: {
            DEFAULT: '1px',
            '0': '0',
            '2': '2px',
           '3': '3px',
            '4': '4px',
           '6': '6px',
           '8': '8px',
          },
        extend: {
            height: {
                xl: '446px'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require("tailwindcss-scrollbar"),
    ],
};
