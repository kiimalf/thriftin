<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = User::where('email', 'seller@thriftin.com')->first();
        if (!$seller) {
            return;
        }

        $categories = Category::all();
        
        $dummyProducts = [
            [
                'title' => 'Vintage Levi\'s 501 Blue Jeans',
                'description' => "Classic vintage Levi's 501. Beautiful fade and wear. Made in USA.\n\nWaist: 32\"\nLength: 30\"\n\nNo major flaws, just perfect vintage character.",
                'price' => 350000,
                'condition' => 'good',
                'category_slug' => 'bottoms',
                'gender' => 'men',
                'size' => '32',
                'brand' => 'Levi\'s',
                'weight' => 600,
                'image_url' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Nike 90s Spellout Sweatshirt',
                'description' => "Rare 90s Nike center swoosh sweatshirt. Boxy fit, super thick material. Minor fading on the collar but overall great condition.",
                'price' => 450000,
                'condition' => 'good',
                'category_slug' => 'tops',
                'gender' => 'unisex',
                'size' => 'L',
                'brand' => 'Nike',
                'weight' => 500,
                'image_url' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Floral Summer Midi Dress',
                'description' => "Beautiful lightweight summer dress with floral patterns. Perfect for beach days or casual outings. Flowy material.",
                'price' => 125000,
                'condition' => 'like_new',
                'category_slug' => 'dresses',
                'gender' => 'women',
                'size' => 'S',
                'brand' => 'Zara',
                'weight' => 300,
                'image_url' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Dr. Martens 1460 8-Eye Boots',
                'description' => "Classic Dr. Martens boots. Worn a few times but still in great shape. Soles have plenty of life left. Scuffs on the toe box adds character.",
                'price' => 1200000,
                'condition' => 'good',
                'category_slug' => 'footwear',
                'gender' => 'unisex',
                'size' => '42',
                'brand' => 'Dr. Martens',
                'weight' => 1200,
                'image_url' => 'https://images.unsplash.com/photo-1605733160314-4fc7dac4bb16?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'North Face Nuptse 700 Puffer',
                'description' => "Iconic North Face Nuptse jacket. Very warm and puffy. There is a tiny repair on the left sleeve, barely noticeable.",
                'price' => 950000,
                'condition' => 'fair',
                'category_slug' => 'outerwear',
                'gender' => 'men',
                'size' => 'M',
                'brand' => 'The North Face',
                'weight' => 800,
                'image_url' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Canvas Tote Bag Aesthetic',
                'description' => "Simple and aesthetic canvas tote bag. Thick material, fits a 15 inch laptop easily. Washable.",
                'price' => 50000,
                'condition' => 'new',
                'category_slug' => 'bags',
                'gender' => 'unisex',
                'size' => 'OS',
                'brand' => null,
                'weight' => 200,
                'image_url' => 'https://images.unsplash.com/photo-1597633244018-b2a1a89c424a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Adidas Ultraboost 21',
                'description' => "Running shoes in excellent condition. Used for about 50km. Upgrading to a new pair so letting these go.",
                'price' => 850000,
                'condition' => 'like_new',
                'category_slug' => 'footwear',
                'gender' => 'men',
                'size' => '43',
                'brand' => 'Adidas',
                'weight' => 600,
                'image_url' => 'https://images.unsplash.com/photo-1587563871167-1ee9c731aefb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Corduroy Overshirt Brown',
                'description' => "Thick corduroy overshirt. Perfect for layering. Earth tone brown color.",
                'price' => 180000,
                'condition' => 'good',
                'category_slug' => 'tops',
                'gender' => 'men',
                'size' => 'XL',
                'brand' => 'Uniqlo',
                'weight' => 450,
                'image_url' => 'https://images.unsplash.com/photo-1596755094514-f87e32f6b717?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Y2K Pleated Mini Skirt',
                'description' => "Genuine early 2000s pleated skirt. Plaid pattern. Super cute for y2k aesthetics.",
                'price' => 95000,
                'condition' => 'good',
                'category_slug' => 'bottoms',
                'gender' => 'women',
                'size' => 'M',
                'brand' => null,
                'weight' => 250,
                'image_url' => 'https://images.unsplash.com/photo-1582142306909-195724d33ffc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Vintage Leather Biker Jacket',
                'description' => "Heavyweight real leather biker jacket from the 80s. Broken in perfectly. Zippers all work smoothly.",
                'price' => 750000,
                'condition' => 'good',
                'category_slug' => 'outerwear',
                'gender' => 'men',
                'size' => 'L',
                'brand' => 'Harley Davidson',
                'weight' => 2000,
                'image_url' => 'https://images.unsplash.com/photo-1520975954732-57dd22299614?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($dummyProducts as $item) {
            $cat = $categories->where('slug', $item['category_slug'])->first();
            
            $product = Product::create([
                'user_id' => $seller->id,
                'title' => $item['title'],
                'slug' => Str::slug($item['title']) . '-' . uniqid(),
                'description' => $item['description'],
                'price' => $item['price'],
                'condition' => $item['condition'],
                'category_id' => $cat ? $cat->id : null,
                'gender' => $item['gender'],
                'size' => $item['size'],
                'brand' => $item['brand'],
                'weight' => $item['weight'],
                'status' => 'active',
                'views_count' => rand(10, 500),
                'saves_count' => rand(0, 50),
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'url' => $item['image_url'],
                'is_primary' => true,
                'order' => 0,
            ]);
        }
    }
}
