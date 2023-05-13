<?php

namespace Database\Factories;

use App\Models\product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\purchase>
 */
class purchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supplement=product::inRandomOrder()->first();
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'supplement_id' => $supplement->id,
            'number' => fake()->numberBetween(1,$supplement->quantity),
            'price' => $supplement->price * ($supplement->discount/100),
            'discount' => $supplement->discount,
        ];
    }
}
