<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) 
        {
            $this->command->info('No products found, skipping product variants seeding.');
            return;
        }

        $sizeAvailability = ProductVariant::$sizeAvailability;
        $colorAvailability = ProductVariant::$colorAvailability;

        foreach ($products as $product) {
            $randomSizes = fake()->numberBetween(0, count($sizeAvailability));
            $sizes = fake()->randomElements($sizeAvailability, $randomSizes);

            $randomColors = fake()->numberBetween(0, count($colorAvailability));
            $colors = fake()->randomElements($colorAvailability, $randomColors);

            $categoryName = $product->category->name;
            $productName = $product->name;

            foreach ($sizes as $size) {
                foreach ($colors as $color) {
                    ProductVariant::factory()
                        ->makeSKU($categoryName, $productName, $size, $color)
                        ->makeSlug($product)
                        ->create([
                            'product_id' => $product->id,
                            'size' => $size,
                            'color' => $color,
                        ]);
                }
            }
        }
    }
}
