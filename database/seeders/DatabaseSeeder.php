<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed categories
        $this->call(CategorySeeder::class);

        // Create dummy buyer
        User::factory()->create([
            'name' => 'Rani Putri',
            'email' => 'buyer@thriftin.com',
            'role' => 'buyer',
        ]);

        // Create dummy seller
        User::factory()->create([
            'name' => 'Andi Wijaya',
            'email' => 'seller@thriftin.com',
            'role' => 'seller',
        ]);

        // Seed dummy products
        $this->call(ProductSeeder::class);
    }
}
