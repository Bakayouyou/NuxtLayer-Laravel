/**
 * GET /api/products - Proxies to the Laravel API (no mock data).
 */

import { defineEventHandler, getQuery, createError } from 'h3'
import { z } from 'zod'

const QuerySchema = z.object({
  search:    z.string().optional(),
  category:  z.string().optional(),
  minPrice:  z.coerce.number().int().nonnegative().optional(),
  maxPrice:  z.coerce.number().int().nonnegative().optional(),
  minRating: z.coerce.number().min(0).max(5).optional(),
  inStock:   z.enum(['true', 'false']).optional().transform(val => val === 'true'),
})

export default defineEventHandler(async (event) => {
  const queryResult = QuerySchema.safeParse(getQuery(event))

  if (!queryResult.success) {
    throw createError({
      statusCode: 400,
      statusMessage: 'Invalid query parameters',
      data: queryResult.error.issues,
    })
  }

  const params = Object.fromEntries(
    Object.entries(queryResult.data).filter(([, v]) => v !== undefined && v !== null),
  )

  const apiBase = process.env.NUXT_API_BASE_URL ?? 'http://localhost:8000'

  return $fetch(`${apiBase}/api/products`, { params })
})
