const config = require('../../wpgulp.config.js')

module.exports = {
   content: [
      `${config.themePath}/*.php`,
      `${config.themePath}/**/**/*.php`,
      `${config.themePath}/**/**/*.php`,
      `${config.themePath}/components/*.php`,
      `${config.themePath}/components/**/*.php`,
      './node_modules/flowbite/**/*.js',
   ],
   safelist: [
      'hidden',
   ],
   plugins: [require('@tailwindcss/line-clamp')],
   theme: {
      container: {
         center: true,
         padding: {
            DEFAULT: '15px',
         },
      },
      fontFamily: {
         primary: [
            'Kollektif',
            'ui-sans-serif',
            'system-ui',
            '-apple-system',
            'BlinkMacSystemFont',
            'Segoe UI',
            'Roboto',
            'Helvetica Neue',
            'Arial',
            'Noto Sans',
            'sans-serif',
            'Apple Color Emoji',
            'Segoe UI Emoji',
            'Segoe UI Symbol',
            'Noto Color Emoji',
         ],
      },
      extend: {
         screens: {
            'xs': '420px',
            '3xl': '1650px',
         },
         borderRadius: {
            'small': '0.1875rem'
         },
         colors: {
            purple: {
               400: '#4C2B80',
               500: '#5C2E87',
               900: '#160829'
            },
            gray: {
               300: '#E1E1E3',
            },
            neutral: {
               100: '#BBBBBB',
               300: '#F4F4F4',
            },
            yellow: {
               500: '#F5C342',
            },
         },
      },
   },
}
