/** @type {import('tailwindcss').Config} */
export default {
  content: ["./src/**/*.{js,jsx,ts,tsx,html,php}"],
  theme: {
    extend: {
      width:{
        'custom': '600px',
      }
    },
    fontFamily: {
      Nunito: ["Nunito", "Open Sans", "sans-serif"],
      Poppins: ["Poppins", "Open sans", "sans-serif"],
    },
  },
  plugins: [
    require('tailwindcss'),
  ],
};

