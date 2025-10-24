module.exports = {
    content: [
      './resources/views/**/*.blade.php',
      './resources/js/**/*.{ts,tsx,js,jsx}',
    ],
    theme: {
      extend: {
        colors: {
          background: 'var(--background)',
          foreground: 'var(--foreground)',
          card: 'var(--card)',
          cardForeground: 'var(--card-foreground)',
          primary: 'var(--primary)',
          primaryForeground: 'var(--primary-foreground)',
          secondary: 'var(--secondary)',
          secondaryForeground: 'var(--secondary-foreground)',
          accent: 'var(--accent)',
          accentForeground: 'var(--accent-foreground)',
          destructive: 'var(--destructive)',
          destructiveForeground: 'var(--destructive-foreground)',
          border: 'var(--border)',
        },
        borderRadius: {
          lg: 'var(--radius-lg)',
          md: 'var(--radius-md)',
          sm: 'var(--radius-sm)',
        },
      },
    },
  };
  