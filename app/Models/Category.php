<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * Get the products for the category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Use the category's slug for routes model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Automatically update or delete all products that belong to the category.
     */
    protected static function booted()
    {
        static::updated(function ($category) {
            $category->products->each(function ($product) {
                $product->updatesWithSlugModification();
            });
        });
        
        static::deleting(function ($category) {
            $category->products->each(function ($product) {
                $product->softDeletesWithSlugModification();
            });
        });
    }
}
