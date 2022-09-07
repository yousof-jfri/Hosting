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
        'dark-red': '#CF3737',
        'light-green': 'rgb(6,120,3)',
        'red': {
          500: 'rgb(187,7,7)',
          600: 'rgb(187,7,7)',
        },
        'green' : {
          500: 'rgb(6,120,3)',
          600: 'rgb(4,77,1)',
        },
        'gold-yellow': ' rgb(253, 216, 2)',
      },
      height: {
        '100': '29rem',
      },
      inset: {
        '[-30px]': '-34px',
      },
      width: {
        '128': '32rem',
      }
    },
  },
  plugins: [],
}