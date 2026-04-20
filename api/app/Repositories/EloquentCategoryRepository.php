<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Collection;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function allWithCount(): Collection
    {
        return Category::withCount('products')
            ->orderBy('slug')
            ->get()
            ->map(fn (Category $category) => [
                'category' => $category->slug,
                'label'    => $category->label,
                'count'    => $category->products_count,
            ]);
    }
}

