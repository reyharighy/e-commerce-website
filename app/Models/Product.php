<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_percentage',
    ];

    /**
     * Get the category of the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the orders that belong to the product.
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_details')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    /**
     * Get details that ever list the product.
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get all variants of the product.
     */
    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Use the product's slug for the route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Soft delete the product after its category is deleted.
     * Do some slug modification as deleted record identification.
     */
    public function softDeletesWithSlugModification()
    {
        $deletionIdentifier = '-' . uniqid() . '-deleted';
        $this->name .= $deletionIdentifier;
        $this->slug .= $deletionIdentifier;
        $this->save();

        $this->delete();
    }

    /**
     * Update the product slug after its category is updated.
     * Do some slug modification to maintain the schema integrity.
     */
    public function updatesWithSlugModification()
    {   
        $this->update([
            'slug' => Str::slug($this->category->name . '-' . $this->name),
        ]);
    }

    /**
     * Automatically update or delete all variants that belong to the product.
     */
    protected static function booted()
    {
        static::updated(function ($product) {
            $product->productVariants->each(function ($productVariant) {
                $productVariant->updatesWithSlugModification();
            });
        });
        
        static::deleting(function ($product) {
            $product->productVariants->each(function ($productVariant) {
                $productVariant->softDeletesWithSlugModification();
            });
        });
    }
}
