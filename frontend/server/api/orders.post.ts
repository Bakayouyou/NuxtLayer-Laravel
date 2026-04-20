/**
 * POST /api/orders - Proxies to the Laravel API (no mock data).
 */

import { defineEventHandler, readBody } from 'h3'

export default defineEventHandler(async (event) => {
  const body: unknown = await readBody(event)
  const apiBase = process.env.NUXT_API_BASE_URL ?? 'http://localhost:8000'

  return $fetch(`${apiBase}/api/orders`, {
    method: 'POST',
    body,
  })
})
