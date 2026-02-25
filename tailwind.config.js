/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "templates/**/*.html.twig",  // Vérifie bien le "./" au début
    "src/Form/**/*.php",
    "assets/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}