<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderRepositoryInterface $orders,
    ) {}

    /**
     * POST /api/orders
     */
    public function store(StoreOrderRequest $request): OrderResource
    {
        $order = $this->orders->create($request->validated());

        return new OrderResource($order);
    }
}
