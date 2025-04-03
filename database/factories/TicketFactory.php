<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Travel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->numberBetween(1000, 9999), // Asegura unicidad
            'seat' => $this->faker->numberBetween(30, 60),
            'total' => $this->faker->numberBetween(100, 1000),
            'date' => $this->faker->date('Y-m-d'),
            'travel_id' => Travel::factory(),
        ];
    }
}
