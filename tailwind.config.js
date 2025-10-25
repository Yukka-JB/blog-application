import plugin from 'tailwindcss/plugin';

export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.{ts,tsx,js,jsx}',
  ],
  theme: {
    extend: {
      colors: {
        // use hyphenated keys for the generated classes you want (bg-primary, text-card-foreground, etc.)
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
    // Generates .bg-<name> and .text-<name> utilities for string color entries and nested shades
    plugin(function ({ addUtilities, theme, e }) {
      const colors = theme('colors') || {};
      const utilities = {};

      function addColorUtils(name, value) {
        const classNameBg = `.bg-${e(name)}`;
        const classNameText = `.text-${e(name)}`;
        utilities[classNameBg] = { backgroundColor: value };
        utilities[classNameText] = { color: value };
      }

      for (const [name, value] of Object.entries(colors)) {
        if (typeof value === 'string') {
          addColorUtils(name, value);
        } else if (typeof value === 'object' && value !== null) {
          // handle nested shades: { DEFAULT: '...', 50: '...' }
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