<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['order_number', 'subtotal', 'tax', 'total'];

    protected $casts = [
        'subtotal' => 'integer',
        'tax'      => 'integer',
        'total'    => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

