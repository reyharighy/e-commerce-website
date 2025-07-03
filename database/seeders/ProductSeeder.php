<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    static $productList = [
        'Hat' => [
            'Beret',
            'Bucket Hat',
            'Cowboy Hat',
            'Crochet Beanie Cat',
            'Denim Beret',
            'Fiddler Button Cap',
            'NY Baseball Hat',
            'Slouchy Beanie',
            'Stars Hat',
            'Wool Bowler Hat',
        ],
        'Hoodie' => [
            'Basic Hoodie',
            'Black Spider Hoodie',
            'Blue Gradient Hoodie',
            'Butterfly Hoodie',
            'Flower Hoodie',
            'Frog Hoodie',
            'Jeans Hoodie',
            'Knit Pattern Hoodie',
            'Stars Hoodie',
            'Two Tone Hoodie',
        ],
        'Outer' => [
            'B Varsity',
            'Leather Jacket',
            'Mint Crop Outer',
            'Off White Blazer',
            'Parachute Jacket',
            'Puffer Jacket',
            'Retro Corduroy Jacket',
            'Varsity',
            'Winterjas',
            'y2k Jacket',
        ],
        'Pants' => [
            'Cargo Pant',
            'Grid Pant',
            'High-waist Dress Pants',
            'Jeans',
            'Jorts',
            'Loose Straight Pant',
            'Shorts',
            'Stars Pants',
            'Training Pant',
            'Trouser',
        ],
        'Shirt' => [
            'Balloon Sleeve',
            'Contrast Collar Shirt',
            'Mint Crop Outer',
            'Corduroy Shirt',
            'Crayon Drawing Shirt',
            'Denim',
            'Flowers',
            'Loose Pockets Shirt',
            'Short Sleeve Shirt',
            'Strip Shirt',
        ],
        'Sweater' => [
            'Basic Sweater',
            'Cats Sweater',
            'Cloud Sweater',
            'Colorblock Sweater',
            'Ducks Sweater',
            'Knit Cream Sweater',
            'Knit Pattern Sweater',
            'Stars Sweater',
            'Strip Knit Sweater',
            'Wool Sweater',
        ],
        'T-shirt' => [
            'Blossom Cream',
            'Fish',
            'Fruits',
            'Matcha Morning',
            'Pink Stars',
            'Shadow',
            'Short Sleeve Tee',
            'Skull',
            'Sport Casual',
            'Tomato',
            'Whale',
            'Zip Up Collar Tee',
        ],
    ];

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
            $productNames = self::$productList[$category->name];

            foreach ($productNames as $name) {
                Product::factory()
                    ->makeName($name)
                    ->makeSlug($category)
                    ->create([
                        'category_id' => $category->id,
                    ]);
            }
        }
    }
}
