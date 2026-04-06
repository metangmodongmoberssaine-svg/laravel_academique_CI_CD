<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salle>
 */
class SalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_salle' => $this->faker->unique()->bothify('CF###'),
            'contenance' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->randomElement(['Disponible', 'Indisponible']),
        ];
    }
}