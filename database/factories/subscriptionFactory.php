<?php

namespace Database\Factories;

use App\Models\coach;
use App\Models\muscle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\subscription>
 */
class subscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $course=muscle::inRandomOrder()->first();
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'course_id' => $course,
            'price' => $course->price * ($course->discount/100),
            'discount' => $course->discount,

        ];
    }
}
