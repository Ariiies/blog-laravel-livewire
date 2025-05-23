<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'user_id' => User::all()->random()->id,
            'body' => $this->faker->paragraph(20,true),
            'excerpt' => $this->faker->sentence,
            'is_published' => $this->faker->boolean,
            'slug' => $this->faker->slug,
            'category_id' =>Category::all()->random()->id,
            'published_at' => $this->faker->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
