const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                DEFAULT: '0 0 5px 0 rgba(0, 0, 0, ,0.08)',
            },
           colors: {
               'gray-light': '#F5F6F9',
               'page': 'var(--page-background-color)',
               'card': 'var(--card-background-color)',
               'button': 'var(--button-background-color)',
               'header': 'var(--header-background-color)',
               'default': 'var(--text-default-color)',
               'accent': 'var(--text-accent-color)',
               'accent-light': 'var(--text-accent-light-color)',
               'muted': 'var(--text-muted-color)',
               'muted-light': 'var(--text-muted-light-color)',
           }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
