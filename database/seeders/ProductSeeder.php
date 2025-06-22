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

        Product::factory()
            ->makeSlug()
            ->count(50)
            ->make()
            ->each(function ($product) use ($categories)
            {
                $product->category_id = $categories->random()->id;
                $product->save();
            });
    }
}
