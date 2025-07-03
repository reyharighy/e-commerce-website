<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    static $categoryList = [
        'Hat',
        'Hoodie',
        'Outer',
        'Pants',
        'Shirt',
        'Sweater',
        'T-shirt'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$categoryList as $name) {
            Category::factory()
                ->makeName($name)
                ->makeSlug()
                ->create();
        }
    }
}
