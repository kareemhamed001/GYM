<?php

namespace Database\Factories;

use App\Models\coach;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class categoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => fake()->name(),
            'name_ar' => fake()->name(),
            'name_ku' => fake()->name(),
            'description_en' => fake()->realTextBetween(50,500),
            'description_ar' => fake()->realTextBetween(50,500),
            'description_ku' => fake()->realTextBetween(50,500),
            'cover_image' => 'storage/images/courses/coverImages/6N0Nzoc7h79SKlLQjXcm67eWQ8l4FvOlvtzyJHoy.jpg',
        ];
    }
}
