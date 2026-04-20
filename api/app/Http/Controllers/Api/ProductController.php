<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductRepositoryInterface $products,
    ) {}

    /**
     * GET /api/products
     */
    public function index(IndexProductRequest $request): AnonymousResourceCollection
    {
        $products = $this->products->filter($request->validated());

        return ProductResource::collection($products);
    }

    /**
     * GET /api/products/{id}
     */
    public function show(string $id): JsonResponse|ProductResource
    {
        if (!ctype_digit($id)) {
            return response()->json(['message' => 'Invalid product ID.'], 400);
        }

        $product = $this->products->findById((int) $id);

        if ($product === null) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        return new ProductResource($product);
    }
}
