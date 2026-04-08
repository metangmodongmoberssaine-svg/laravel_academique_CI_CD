<?php

namespace Database\Factories;

use App\Models\Ue;
use Illuminate\Database\Eloquent\Factories\Factory;

class EcFactory extends Factory
{
    protected static $counter = 1;

    public function definition(): array
    {
        $current = self::$counter++;
        
        return [
            'code_ec' => 'EC' . str_pad($current, 3, '0', STR_PAD_LEFT),
            'label_ec' => 'Enseignement ' . $current,
            'desc_ec' => $this->faker->sentence(),
            'nbh_ec' => $this->faker->numberBetween(10, 60),
            'nbc_ec' => $this->faker->numberBetween(1, 10),
            'code_ue' => Ue::factory(),
        ];
    }
}