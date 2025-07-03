<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, asText: true);

        return [
            'name' => ucwords($name),
            'description' => fake()->sentences(2, asText:True),
            'price' => fake()->numberBetween(50, 100) * 1000,
            'discount_percentage' => fake()->numberBetween(0, 50),
        ];
    }

    /**
     * Create a slug name of the category name for SEO-friendly purpose.
     */
    public function makeSlug(Category $category): static
    {
        return $this->state(fn (array $attributes) => [
            'slug' => Str::slug($category->name . '-' . $attributes['name']),
        ]);
    }
}
