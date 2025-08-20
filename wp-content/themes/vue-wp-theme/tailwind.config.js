// tailwind.config.js
// const colors = require('tailwindcss/colors');
// const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    darkMode: false, // or 'media' or 'class'
    theme: {
      fontSize: {
        xs: ['12px','16px'],
        sm: ['14px','20px'],
        base: ['16px','24px'],
        md: [ '18px','28px'],
        lg: ['20px', '28px'],
        xl: ['24px', '32px'],
        '2xl': ['28px', '36px'],
        '3xl': ['32px', '42px'], 
      },
      fontFamily: {
        'display': ['Source Sans Pro', 'Arial', 'Helvetica Neue', 'Helvetica', 'sans-serif'],
        'body': ['Source Sans Pro', 'Arial', 'Helvetica Neue', 'Helvetica', 'sans-serif'],
      },
      screens: {
        'xs': '420px',
        // => @media (min-width: 420px) { ... }
        'sm': '640px',
        // => @media (min-width: 640px) { ... }
        'md': '768px',
        // => @media (min-width: 768px) { ... }
        'lg': '1024px',
        // => @media (min-width: 1024px) { ... }
        'xl': '1280px',
        // => @media (min-width: 1280px) { ... }
        '2xl': '1536px',
        // => @media (min-width: 1536px) { ... }
        '3xl': '1920px',
        // => @media (min-width: 1536px) { ... }
      },
      extend: {
        colors: {
            'primary' : 'var(--primary-color)',
        },
      },
      aspectRatio: {
        'sb': '4 / 3',
        'vd': '16 / 9',
      },
      container: {
        center: true,
        padding: '1.5rem',
        maxWidth: '100%',
        screens: {
          xs: '100%',
          sm: '600px',
          md: '728px',
          lg: '984px',
          xl: '1240px',          
        },
      },
    },
    variants: {
      extend: {},
    },
    plugins: [],
  }