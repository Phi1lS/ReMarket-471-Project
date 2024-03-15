/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./*.{html, js}"],
    darkMode: 'media',
    theme: {
        extend: {
          gridTemplateRows: {
            '[auto,auto,1fr': 'auto auto 1fr',
          },
          colors: {
            // Define your custom colors here
            // Replace these with your actual color values
            'remarket-blue': '#58A4B0',
            'remarket-dark': '#373F51',
            'remarket-teal': {
              600: '#4fd1c5', // normal state for light mode
              700: '#38b2ac', // normal state for dark mode
              800: '#319795', // hover state for dark mode
            },
          },
        },
      },
      variants: {
        extend: {
          // Extend the variants as needed
        },
      },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
    ],
  }