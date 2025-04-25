export default defineNuxtConfig({
  modules: [
      '@nuxtjs/tailwindcss',
      '@nuxtjs/color-mode',
      '@nuxt/content'
  ],

  colorMode: {
      classSuffix: '',
      preference: 'system',
      fallback: 'light'
  },

  tailwindcss: {
      cssPath: '~/assets/css/tailwind.css',
      configPath: 'tailwind.config.js',
  },

  app: {
      head: {
          title: 'DatenSindDaten',
          meta: [
              { name: 'description', content: 'DatenSindDaten Wesbsite' }
          ],
      }
  },


  // Runtime configuration - exposed to the client
  runtimeConfig: {
    // Private keys are only available on the server
    // apiSecret: process.env.NUXT_API_SECRET,

    // Public keys that are available on client and server
    public: {
      nominatimBaseUrl: process.env.NUXT_PUBLIC_NOMINATIM_BASE_URL,

      // Company information
      company: {
        name: process.env.NUXT_PUBLIC_COMPANY_NAME,
        street: process.env.NUXT_PUBLIC_COMPANY_STREET,
        zipCode: process.env.NUXT_PUBLIC_COMPANY_ZIP,
        city: process.env.NUXT_PUBLIC_COMPANY_CITY,
        email: process.env.NUXT_PUBLIC_COMPANY_EMAIL,
        phone: process.env.NUXT_PUBLIC_COMPANY_PHONE,
        responsiblePerson: process.env.NUXT_PUBLIC_COMPANY_RESPONSIBLE,
        domain: process.env.NUXT_PUBLIC_COMPANY_DOMAIN
      },

      // API endpoints
      apiBaseUrl: process.env.NUXT_PUBLIC_API_BASE_URL
    }
  },

  compatibilityDate: '2025-04-22',

  content: {
    search: {
      // Reduce memory usage for search
      indexed: true, 
      // Only index essential fields to reduce memory footprint
      fields: ['title', 'description', 'body']
    },
    documentDriven: true,
    highlight: {
      theme: 'github-dark'
    },
    markdown: {
      // Disable MDC for even lighter processing
      mdc: false,
      toc: {
        depth: 2,
        searchDepth: 2
      }
    },
    // Add these options to prevent recursion
    navigation: {
      fields: ['navOrder']
    },
    cacheVersion: 2 // Increment this to reset the cache if needed
  },

  // Add nitro optimization
  nitro: {
    prerender: {
      crawlLinks: true,
      routes: ['/'],
      // Ignore Nuxt Content's internal API routes
      ignore: ['/api/_content'] 
    }
  },

  // Increase build optimization
  vite: {
    build: {
      // Split chunks for better performance
      chunkSizeWarningLimit: 1000,
      rollupOptions: {
        output: {
          // Remove manual chunking for content
          // manualChunks: {
          //   'content': ['@nuxt/content'],
          // }
        }
      }
    }
  }
})