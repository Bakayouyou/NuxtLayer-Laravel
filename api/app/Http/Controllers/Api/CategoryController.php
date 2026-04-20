<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categories,
    ) {}

    /**
     * GET /api/categories
     *
     * Returns each category with its product count.
     */
    public function index(): JsonResponse
    {
        return response()->json($this->categories->allWithCount()->values());
    }
}
