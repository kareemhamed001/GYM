<?php

namespace Database\Factories;

use App\Models\coach;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\course>
 */
class courseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'title_ar' => fake()->name(),
            'title_ku' => fake()->name(),
            'description' => fake()->realTextBetween(50,500),
            'description_ar' => fake()->realTextBetween(50,500),
            'description_ku' => fake()->realTextBetween(50,500),
            'type' => fake()->numberBetween(0,3),
            'price' => fake()->numberBetween(50,10000),
            'discount' => fake()->numberBetween(0,100),
            'cover_image' => 'storage/images/courses/coverImages/6N0Nzoc7h79SKlLQjXcm67eWQ8l4FvOlvtzyJHoy.jpg',
            'coach_id' => coach::inRandomOrder()->first()->id,
        ];
    }
}
