<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SalleFactory extends Factory
{
    protected static $counter = 1;

    public function definition(): array
    {
        $current = self::$counter++;
        
        return [
            'num_salle' => 'SAL' . str_pad($current, 3, '0', STR_PAD_LEFT),
            'contenance' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->randomElement(['Disponible', 'Indisponible']),
        ];
    }
}