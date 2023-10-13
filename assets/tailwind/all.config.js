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
      'bg-green-500',
      'bg-blue-500',
      'bg-red-600',
   ],
   plugins: [require('@tailwindcss/line-clamp')],
   theme: {
      container: {
         center: true,
         padding: {
            DEFAULT: '15px',
         },
         screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
         }
      },
      fontFamily: {
         primary: [
            'Open Sans',
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
         aspectRatio: {
            '16/6': '16 / 6',
            '16/15': '16 / 15',
         },
         screens: {
            'xs': '420px',
            // '3xl': '1650px',
         },
         borderRadius: {
            'small': '0.1875rem'
         },
         colors: {
            red: {
               600: '#E98B40',//'#AE1F16'
            },
            purple: {
               400: '#4C2B80',
               500: '#5C2E87',
               900: '#160829'
            },
            gray: {
               300: '#E1E1E3',
            },
            blue: {
               500: '#00b3ff',
               600: '#1F5A9F',
               900: '#072D5A'
            },
            neutral: {
               100: '#BBBBBB',
               300: '#F4F4F4',
               500: '#514E4E'
            },
            yellow: {
               500: '#F5C342',
               400: '#FFAF37'
            },
         },
      },
   },
}
