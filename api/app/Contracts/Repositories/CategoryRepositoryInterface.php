<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    /**
     * Return all categories with their product count.
     */
    public function allWithCount(): Collection;
}

