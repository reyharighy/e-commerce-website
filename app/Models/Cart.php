<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'size',
        'color',
        'quantity',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
