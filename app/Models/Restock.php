<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Restock extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'cost_price',
        'supplier_name',
        'notes',
        'user_id',
        'restock_date',
    ];

    protected function casts(): array
    {
        return [
            'cost_price' => 'decimal:2',
            'restock_date' => 'datetime',
        ];
    }

    /**
     * Get the product being restocked
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who made this restock
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
