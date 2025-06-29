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

    /**
     * Get the products for the category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
