<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    protected static $counter = 1;

    public function definition(): array
    {
        $current = self::$counter++;
        
        return [
            'code_filiere' => 'FIL' . str_pad($current, 3, '0', STR_PAD_LEFT),
            'label_filiere' => 'Filière ' . $current,
            'desc_filiere' => $this->faker->sentence(),
        ];
    }
}