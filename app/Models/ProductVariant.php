<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'product_id',
        'sku',
        'slug',
        'size',
        'color',
        'stock',
    ];

    /**
     * Used to get the size availability of the variant.
     */
    static $sizeAvailability = [
        'XXS',
        'XS',
        'S',
        'M',
        'L',
        'XL',
        'XXL',
    ];

    /**
     * Used to get the color availability of the variant.
     */
    static $colorAvailability = [
        'other',
        'red',
        'orange',
        'amber',
        'yellow',
        'lime',
        'green',
        'emerald',
        'teal',
        'cyan',
        'sky',
        'blue',
        'indigo',
        'violet',
        'purple',
        'fuchsia',
        'pink',
        'rose',
    ];

    /**
     * Get the underlying product that belongs the variant.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all images that belong to the variant.
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Use the variant's slug for the route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Create an alias when making SKU derived from category, product, size, and color.
     */
    public static function getInitials(string $words)
    {
        $wordList = explode(' ', $words);

        $initials = array_map(function ($word) {
            return ucfirst($word[0]);
        }, $wordList);

        return implode($initials);
    }

    /**
     * Update the variant SKU and slug after its product is updated.
     * Do some SKU and slug modification to maintain the schema integrity.
     */
    public function updatesWithSlugModification()
    {
        $categoryInitials = $this->getInitials($this->product->category->name);
        $productInitials = $this->getInitials($this->product->name);
        $color = $this->color != 'other' ? '-' . ucfirst($this->color) : '';
        $sku = $categoryInitials . '-' . $productInitials . '-' . $this->size . $color . '-' . uniqid();
        
        $this->update([
            'sku' => $sku,
            'slug' => Str::slug($this->product->slug . '-' . $sku),
        ]);
    }

    /**
     * Soft delete the variant after its product is deleted.
     * Do some slug modification as deleted record identification.
     */
    public function softDeletesWithSlugModification()
    {   
        $deletionIdentifier = '-deleted';
        $this->sku .= $deletionIdentifier;
        $this->slug .= $deletionIdentifier;
        $this->save();

        $this->delete();
    }
}
