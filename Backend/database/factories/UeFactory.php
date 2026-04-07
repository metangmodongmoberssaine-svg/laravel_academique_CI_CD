<?php

namespace Database\Factories;

use App\Models\Niveau;
use Illuminate\Database\Eloquent\Factories\Factory;

class UeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code_ue' => $this->faker->unique()->bothify('UE###'),
            'label_ue' => $this->faker->word,
            'desc_ue' => $this->faker->sentence,
            'code_niveau' => Niveau::factory(), // Laisse comme ça
        ];
    }
}
