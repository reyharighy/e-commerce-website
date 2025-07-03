<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
        ];
    }

    /**
     * Create a category from the static.
     */
    public function makeName(string $name): static
    {
        return $this->state(fn () => [
            'name' => ucwords($name),
        ]);
    }

    /**
     * Create a slug name of the category name for SEO-friendly purpose.
     */
    public function makeSlug(): static
    {
        return $this->state(fn (array $attributes) => [
            'slug' => Str::slug($attributes['name']),
        ]);
    }
}
