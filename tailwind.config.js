/** @type {import('tailwindcss').Config} */

const twPlugin = require('tw-elements/dist/plugin');
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.html',
        './resources/**/*.vue',
        './node_modules/tw-elements/dist/js/**/*.js',
    ],
    theme: {
        extend: {},
    },
    plugins: [twPlugin]
};
