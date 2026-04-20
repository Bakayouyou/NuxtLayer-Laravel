<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success'  => true,
            'orderId'  => $this->order_number,
            'message'  => 'Order placed successfully',
            'order'    => [
                'items'     => $this->items->map(fn ($item) => [
                    'productId'   => (string) ($item->product_id ?? ''),
                    'productName' => $item->product_name,
                    'quantity'    => $item->quantity,
                    'subtotal'    => $item->subtotal,
                ])->values(),
                'subtotal'  => $this->subtotal,
                'tax'       => $this->tax,
                'total'     => $this->total,
                'createdAt' => $this->created_at->toISOString(),
            ],
        ];
    }
}

