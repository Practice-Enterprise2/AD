/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'darkTheme_gray': '#4F4F4F',
      },
      height: {
        '550': '550px', // add new height option
        '75': '24em',
      },
    },
  },
  plugins: [],
}
