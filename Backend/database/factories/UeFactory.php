<?php

namespace Database\Factories;

use App\Models\Niveau;
use Illuminate\Database\Eloquent\Factories\Factory;

class UeFactory extends Factory
{
    protected static $counter = 1;

    public function definition(): array
    {
        $current = self::$counter++;
        
        return [
            'code_ue' => 'UE' . str_pad($current, 3, '0', STR_PAD_LEFT),
            'label_ue' => 'Unité ' . $current,
            'desc_ue' => $this->faker->sentence(),
            'code_niveau' => Niveau::factory(),
        ];
    }
}