<?php

namespace App\Contracts\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Return all products matching the given filters.
     *
     * @param array{
     *   search?: string|null,
     *   category?: string|null,
     *   minPrice?: int|null,
     *   maxPrice?: int|null,
     *   minRating?: float|null,
     *   inStock?: bool|null,
     * } $filters
     */
    public function filter(array $filters): Collection;

    public function findById(int $id): ?Product;
}

