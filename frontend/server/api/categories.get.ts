/**
 * GET /api/categories - Proxies to the Laravel API (no mock data).
 */

import { defineEventHandler } from 'h3'

export default defineEventHandler(async () => {
  const apiBase = process.env.NUXT_API_BASE_URL ?? 'http://localhost:8000'

  return $fetch(`${apiBase}/api/categories`)
})
