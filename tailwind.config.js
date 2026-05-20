/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.css',
  ],
  theme: {
    extend: {
      fontFamily: {
        serif: ['Georgia', 'Cambria', 'Times New Roman', 'serif'],
      },
      colors: {
        terracotta: {
          50: '#FEF7F0',
          100: '#FCEBD8',
          200: '#F9D5B0',
          300: '#F4B87E',
          400: '#ED944E',
          500: '#C8623B',
          600: '#B04422',
          700: '#933618',
          800: '#7A2D15',
          900: '#5E2A16',
        },
        cream: {
          50: '#FDFBF7',
          100: '#FAF5EC',
          200: '#F5ECDA',
          300: '#EDDCC0',
          400: '#E2C8A0',
          500: '#D4B183',
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}