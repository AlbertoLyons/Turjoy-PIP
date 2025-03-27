<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origin' => $this->faker->country(),
            'destination' => $this->faker->country(),
            'seat_quantity' => $this->faker->numberBetween(30,60),
            'base_rate' => $this->faker->numberBetween(0,5),
        ];
    }
}
