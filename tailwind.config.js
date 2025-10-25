module.exports = (function () {
    const plugin = require('tailwindcss/plugin');
  
    return {
      content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{ts,tsx,js,jsx}',
  
        './node_modules/flowbite-react/**/*.js',
        './node_modules/flowbite/**/*.js',
      ],
      theme: {
        extend: {
          colors: {
            background: 'var(--background)',
            foreground: 'var(--foreground)',
            card: 'var(--card)',
            'card-foreground': 'var(--card-foreground)',
            primary: 'var(--primary)',
            'primary-foreground': 'var(--primary-foreground)',
            secondary: 'var(--secondary)',
            'secondary-foreground': 'var(--secondary-foreground)',
            accent: 'var(--accent)',
            'accent-foreground': 'var(--accent-foreground)',
            destructive: 'var(--destructive)',
            'destructive-foreground': 'var(--destructive-foreground)',
            border: 'var(--border)',
          },
          borderRadius: {
            lg: 'var(--radius-lg)',
            md: 'var(--radius-md)',
            sm: 'var(--radius-sm)',
          },
        },
      },
      plugins: [

        require('flowbite/plugin'),
  
        plugin(function ({ addUtilities, theme, e }) {
          const colors = theme('colors') || {};
          const utilities = {};
  
          function addColorUtils(name, value) {
            utilities[`.bg-${e(name)}`] = { backgroundColor: value };
            utilities[`.text-${e(name)}`] = { color: value };
          }
  
          for (const [name, value] of Object.entries(colors)) {
            if (typeof value === 'string') {
              addColorUtils(name, value);
            } else if (typeof value === 'object' && value !== null) {
              for (const [shade, col] of Object.entries(value)) {
                const classSuffix = shade === 'DEFAULT' ? name : `${name}-${shade}`;
                addColorUtils(classSuffix, col);
              }
            }
          }
  
          addUtilities(utilities, { variants: ['responsive', 'hover', 'focus'] });
        }),
      ],
    };
  })();