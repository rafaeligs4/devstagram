/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
 //  Manera  individual "/resources/views/layouts/app.blade.php"
 "./resources/**/*.blade.php",
 "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
