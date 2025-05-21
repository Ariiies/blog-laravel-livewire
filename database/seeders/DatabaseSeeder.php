<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Database\Factories\CategoryFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seeder personalizado
        $this->call(PersonalizedSeeder::class);

        // seeders
        Category::factory(10)->create();
        Post::factory(100)->create();
    }
}
