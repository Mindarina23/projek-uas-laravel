/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // untuk meng infor atau meng compile data pada laravel
    "./resources/**/*.blade.php",
    "./resources/**/*.js",

  ],
  theme: {
    extend: {},
  },
  plugins: [
    // untuk menambahkan plugin form
    require('@tailwindcss/forms'),
  ],
}

