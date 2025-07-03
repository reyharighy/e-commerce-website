<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) 
        {
            $this->command->info('No categories found, skipping product seeding.');
            return;
        }

        foreach ($categories as $category) {
            $randomTotal = fake()->numberBetween(0, 10);

            Product::factory()
                ->makeSlug($category)
                ->count($randomTotal)
                ->make()
                ->each(function ($product) use ($category) {
                    $product->category_id = $category->id;
                    $product->save();
                });
        }
    }
}
