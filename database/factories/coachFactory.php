<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\coach>
 */
class coachFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nick_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'description' => fake()->realTextBetween(50,200),
            'phone_number' => fake()->unique()->phoneNumber(),
            'experience' => fake()->numberBetween(1,20),
            'intro_video' => 'storage/images/coaches/introVideos/Ga95PHqISRHJFboYf66o912aW1XZIe8oSQwfF81S.mp4',
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
