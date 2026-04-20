// https://nuxt.com/docs/api/configuration/nuxt-config
const apiBaseUrl = process.env.NUXT_API_BASE_URL

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',

  // When NUXT_API_BASE_URL is set (e.g. in Docker with Laravel Sail),
  // proxy all /api/** requests to the Laravel backend.
  // When not set, Nuxt's own server/api/ routes handle the requests.
  ...(apiBaseUrl && {
    routeRules: {
      '/api/**': { proxy: `${apiBaseUrl}/api/**` },
    },
  }),

  css: ['~/assets/css/main.css'],

  // Disable component auto-imports
  components: {
    dirs: []
  },

  devtools: { enabled: true },

  // Disable all auto-imports
  imports: {
    autoImport: false
  },

  modules: [
    '@nuxt/eslint',
    '@nuxt/image',
    '@nuxt/scripts',
    '@nuxt/ui',
    '@pinia/nuxt'
  ]
})