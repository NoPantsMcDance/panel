const colors = require('tailwindcss/colors');

const gray = {
    50: 'blue',
    100: 'var(--active-body-color)',
    200: 'var(--body-color)',
    300: 'var(--body-color)',
    400: 'var(--body-color)',
    500: 'var(--body-color)',
    600: 'var(--theme-secondary-bg)',
    700: 'var(--theme-primary-bg)',
    800: 'var(--theme-bg)',
    900: 'var(--theme-primary-bg)',
};

module.exports = {
    content: [
        './resources/scripts/**/*.{js,ts,tsx}',
    ],
    theme: {
        extend: {
            fontFamily: {
                header: ['"IBM Plex Sans"', '"Roboto"', 'system-ui', 'sans-serif'],
            },
            colors: {
                black: '#131a20',
                // "primary" and "neutral" are deprecated, prefer the use of "blue" and "gray"
                // in new code.
                primary: colors.blue,
                gray: gray,
                neutral: gray,
                cyan: colors.cyan,
            },
            fontSize: {
                '2xs': '0.625rem',
            },
            transitionDuration: {
                250: '250ms',
            },
            borderColor: theme => ({
                default: theme('colors.neutral.400', 'currentColor'),
            }),
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
    ]
};
