<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sku',
        'barcode',
        'category_id',
        'price',
        'cost_price',
        'stock_quantity',
        'min_stock_alert',
        'image_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the category of the product
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get transaction items for this product
     */
    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    /**
     * Get stock movements for this product
     */
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Get restocks for this product
     */
    public function restocks(): HasMany
    {
        return $this->hasMany(Restock::class);
    }

    /**
     * Update stock quantity
     */
    public function updateStock(int $quantity, string $type, $referenceType = null, $referenceId = null, $userId = null): void
    {
        $previousStock = $this->stock_quantity;
        $this->stock_quantity += $quantity;
        $this->save();

        // Record stock movement
        StockMovement::create([
            'product_id' => $this->id,
            'type' => $type,
            'quantity' => $quantity,
            'previous_stock' => $previousStock,
            'new_stock' => $this->stock_quantity,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'user_id' => $userId ?? auth()->id(),
        ]);
    }

    /**
     * Check if stock is low
     */
    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->min_stock_alert;
    }

    /**
     * Get stock alert level
     */
    public function getStockAlertAttribute(): string
    {
        if ($this->stock_quantity == 0) {
            return 'out_of_stock';
        } elseif ($this->isLowStock()) {
            return 'low_stock';
        }
        return 'normal';
    }
}
