/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend:  {
      colors: {
        'perkasa-blue': '#34BCC2',
        'perkasa-blue-1': '#0A766C'
      }
    },
  },
  plugins: [],
}
