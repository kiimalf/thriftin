<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there is an admin user to author the articles
        $admin = User::where('is_admin', true)->first();
        
        if (!$admin) {
            $admin = User::factory()->create([
                'name' => 'Admin ThriftIn',
                'email' => 'admin@thriftin.com',
                'is_admin' => true,
            ]);
        }

        // Create 10 published articles
        Article::factory(10)->create([
            'author_id' => $admin->id,
        ]);
        
        // Create 3 draft articles
        Article::factory(3)->draft()->create([
            'author_id' => $admin->id,
        ]);
    }
}
