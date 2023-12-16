<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checkout>
 */
class CheckoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'checkout_date' =>fake()->date(),
            'return_date' =>fake()->date(),
            'status' => fake()->randomElement(['accquired','returned','overdue','reserved']),
            'student_id' => fake()->randomElement(Student::pluck('id')),
            'book_id' => fake()->randomElement(Book::pluck('id')),
        ];
    }
}
