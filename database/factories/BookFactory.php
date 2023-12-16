<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'author' => fake()->name(),
            'genre' => fake()->randomElement(['Fiction', 'Mystery', 'Science Fiction', 'Fantasy', 'Romance', 'Thriller', 'Horror', 'Non-fiction', 'Biography', 'History', 'Self-help', 'Cooking', 'Travel', 'Poetry', 'Drama']),
            'publish_date' => fake()->date(),
            'status'=> fake()->randomElement(['available', 'unavailable']),
        ];
    }
}
