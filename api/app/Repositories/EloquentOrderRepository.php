<?php

namespace App\Repositories;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create([
                'order_number' => 'ORDER-' . strtoupper(Str::random(8)),
                'subtotal'     => $data['subtotal'],
                'tax'          => $data['tax'],
                'total'        => $data['total'],
            ]);

            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'product_id'   => is_numeric($item['product']['id']) ? (int) $item['product']['id'] : null,
                    'product_name' => $item['product']['name'],
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $item['subtotal'],
                ]);
            }

            return $order->load('items');
        });
    }
}

