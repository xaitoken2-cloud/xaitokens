/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        ink: {
          950: '#0a0a0b',
          900: '#0f0f11',
          850: '#141417',
          800: '#1a1a1e',
          700: '#25252b',
          600: '#34343c',
          500: '#4a4a54',
        },
        gold: {
          50: '#fffbe6',
          100: '#fff3bf',
          200: '#ffe585',
          300: '#ffd24d',
          400: '#f5b800',
          500: '#d99e00',
          600: '#b38000',
          700: '#8a6200',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
      animation: {
        'fade-in': 'fadeIn 0.2s ease-out',
        'slide-up': 'slideUp 0.3s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { opacity: '0', transform: 'translateY(8px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
    },
  },
  plugins: [],
};
