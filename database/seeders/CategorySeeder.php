<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the categories table.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tops',
                'slug' => 'tops',
                'icon' => '👕',
            ],
            [
                'name' => 'Bottoms',
                'slug' => 'bottoms',
                'icon' => '👖',
            ],
            [
                'name' => 'Dresses',
                'slug' => 'dresses',
                'icon' => '👗',
            ],
            [
                'name' => 'Outerwear',
                'slug' => 'outerwear',
                'icon' => '🧥',
            ],
            [
                'name' => 'Activewear',
                'slug' => 'activewear',
                'icon' => '🏃',
            ],
            [
                'name' => 'Footwear',
                'slug' => 'footwear',
                'icon' => '👟',
            ],
            [
                'name' => 'Bags',
                'slug' => 'bags',
                'icon' => '👜',
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'icon' => '🎒',
            ],
            [
                'name' => 'Formal Wear',
                'slug' => 'formal-wear',
                'icon' => '👔',
            ],
            [
                'name' => 'Traditional Wear',
                'slug' => 'traditional-wear',
                'icon' => '🥻',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
