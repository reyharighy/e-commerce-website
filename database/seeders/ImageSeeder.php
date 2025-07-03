<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = ProductVariant::with('product.category')->get();

        if ($variants->isEmpty())
        {
            $this->command->info('No products found, skipping product variants seeding.');
            return;
        }

        foreach ($variants as $variant) {
            $category = $variant->product->category;
            $images = Storage::disk('public')->files($category->name);
            
            $randomImage = fake()->randomElement($images);

            ProductImage::create([
                'product_variant_id' => $variant->id,
                'url' => $randomImage,
            ]);
        }
    }
}
