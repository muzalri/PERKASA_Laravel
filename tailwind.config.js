/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'perkasa-blue': '#7A99A8',
      },
        'perkasa-blue': '#34BCC2',
        'perkasa-blue-1': '#0A766C'
      }
    },
  },
  plugins: [],
};
