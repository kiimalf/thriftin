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
                'image_url' => '/images/products/product-1.png',
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
                'image_url' => '/images/products/product-2.png',
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
                'image_url' => '/images/products/product-3.png',
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
                'image_url' => '/images/products/product-4.png',
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
                'image_url' => '/images/products/product-5.png',
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
                'image_url' => '/images/products/product-6.png',
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
                'image_url' => '/images/products/product-7.png',
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
                'image_url' => '/images/products/product-8.png',
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
                'image_url' => '/images/products/product-9.png',
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
                'image_url' => '/images/products/product-10.png',
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
