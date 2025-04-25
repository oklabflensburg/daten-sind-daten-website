module.exports = {
  darkMode: 'class',
  content: [
    './components/**/*.{js,vue,ts}',
    './layouts/**/*.vue',
    './pages/**/*.vue',
    './plugins/**/*.{js,ts}',
    './app.vue',
  ],
  theme: {
    extend: {
      typography: {
        DEFAULT: {
          css: {
            maxWidth: '100ch',
            color: 'inherit',
            a: {
              color: 'var(--tw-prose-links)',
              '&:hover': {
                color: 'var(--tw-prose-links-hover)',
              },
              textDecoration: 'underline',
              fontWeight: '500',
            },
            'h1, h2, h3, h4': {
              color: 'inherit',
              fontWeight: '600',
            },
            'code::before': { content: '""' },
            'code::after': { content: '""' },
            code: {
              color: 'var(--tw-prose-code)',
              backgroundColor: 'var(--tw-prose-code-bg)',
              borderRadius: '0.25rem',
              paddingLeft: '0.25rem',
              paddingRight: '0.25rem',
              paddingTop: '0.125rem',
              paddingBottom: '0.125rem',
            },
          },
        },
        dark: {
          css: {
            color: 'inherit',
          },
        }
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
