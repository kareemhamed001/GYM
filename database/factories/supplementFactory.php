<?php

namespace Database\Factories;

use App\Models\brand;
use App\Models\coach;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class supplementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'name_ar' => fake()->name(),
            'name_ku' => fake()->name(),
            'description' => fake()->realTextBetween(50,500),
            'description_ar' => fake()->realTextBetween(50,500),
            'description_ku' => fake()->realTextBetween(50,500),
            'quantity' => fake()->numberBetween(10,10000),
            'unit' => 'unit',
            'price' => fake()->numberBetween(50,10000),
            'discount' => fake()->numberBetween(0,100),
            'brand_id' => brand::inRandomOrder()->first()->id,
            'coach_id' => coach::inRandomOrder()->first()->id,
            'cover_image' => 'storage/images/courses/coverImages/6N0Nzoc7h79SKlLQjXcm67eWQ8l4FvOlvtzyJHoy.jpg',
        ];
    }
}
