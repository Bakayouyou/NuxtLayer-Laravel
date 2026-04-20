<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function filter(array $filters): Collection
    {
        $query = Product::query()->with('category');

        if (!empty($filters['search'])) {
            $term = $filters['search'];
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
            });
        }

        if (!empty($filters['category']) && $filters['category'] !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $filters['category']));
        }

        if (isset($filters['minPrice'])) {
            $query->where('price', '>=', (int) $filters['minPrice']);
        }

        if (isset($filters['maxPrice'])) {
            $query->where('price', '<=', (int) $filters['maxPrice']);
        }

        if (isset($filters['minRating'])) {
            $query->where('rating', '>=', (float) $filters['minRating']);
        }

        if (!empty($filters['inStock'])) {
            $query->where('stock', '>', 0);
        }

        return $query->get();
    }

    public function findById(int $id): ?Product
    {
        return Product::with('category')->find($id);
    }
}

