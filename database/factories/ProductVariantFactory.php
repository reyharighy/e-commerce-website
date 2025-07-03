<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stock' => fake()->numberBetween(0, 50),
        ];
    }

    /**
     * Create an alias when making SKU derived from category, product, size, and color.
     */
    protected static function getInitials(string $words)
    {
        $wordList = explode(' ', $words);

        $initials = array_map(function ($word) {
            return ucfirst($word[0]);
        }, $wordList);

        return implode($initials);
    }

    /**
     * Provide the SKu for the variant.
     */
    public function makeSKU(string $category, string $product, string $size, string | null $color): static
    {
        $categoryInitials = $this->getInitials($category);
        $productInitials = $this->getInitials($product);
        $color = $color != 'other' ? '-' . ucfirst($color) : '';

        return $this->state(fn () => [
            'sku' => $categoryInitials . '-' . $productInitials . '-' . $size . $color . '-' . uniqid(),
        ]);
    }

    /**
     * Create a slug name of the category name for SEO-friendly purpose.
     */
    public function makeSlug(Product $product): static
    {
        return $this->state(fn (array $attributes) => [
            'slug' => Str::slug($product->slug . '-' . $attributes['sku']),
        ]);
    }
}
