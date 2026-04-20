<?php

namespace App\Contracts\Repositories;

use App\Models\Order;

interface OrderRepositoryInterface
{
    /**
     * Persist a new order with its items and return the created order.
     *
     * @param array{
     *   items: array<array{product: array<string,mixed>, quantity: int, subtotal: int}>,
     *   subtotal: int,
     *   tax: int,
     *   total: int,
     * } $data
     */
    public function create(array $data): Order;
}

