<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Niveau>
 */
class NiveauFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // code_niveau est auto-incrémenté, NE PAS LE METTRE ICI
            'label_niveau' => $this->faker->words(1, true),
            'desc_niveau' => $this->faker->words(1, true),
            'code_filiere' => Filiere::factory(),
        ];
    }
}