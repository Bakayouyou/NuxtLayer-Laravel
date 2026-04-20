/**
 * GET /api/products/:id - Proxies to the Laravel API (no mock data).
 */

import { defineEventHandler, getRouterParam, createError } from 'h3'

export default defineEventHandler(async (event) => {
  const id = getRouterParam(event, 'id')

  if (!id) {
    throw createError({ statusCode: 400, statusMessage: 'Invalid product ID' })
  }

  const apiBase = process.env.NUXT_API_BASE_URL ?? 'http://localhost:8000'

  return $fetch(`${apiBase}/api/products/${id}`)
})
