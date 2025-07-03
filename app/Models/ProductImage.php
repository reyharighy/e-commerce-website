<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use SoftDeletes;

    protected $fillable = [
        'product_variant_id',
        'url',
    ];

    /**
     * Get the product variant that belongs the image.
     */
    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
