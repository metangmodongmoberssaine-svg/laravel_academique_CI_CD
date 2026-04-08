<?php

namespace Database\Factories;

use App\Models\Personnel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonnelFactory extends Factory
{
    protected $model = Personnel::class;

    // Compteur statique pour générer des valeurs uniques
    protected static $counter = 1;

    public function definition(): array
    {
        $current = self::$counter++;
        
        return [
            'id' => (string) Str::uuid(),
            'code_pers' => 'PERS' . str_pad($current, 4, '0', STR_PAD_LEFT),
            'nom_pers' => $this->faker->name,
            'sexe_pers' => $this->faker->randomElement(['Masculin', 'Feminin']),
            'phone_pers' => '77' . $this->faker->numerify('#######'),
            'login_pers' => 'user' . $current . '@test.com',
            'pwd_pers' => Hash::make('password'),
            'type_pers' => $this->faker->randomElement(['RESPONSABLE DISCIPLINE', 'ENSEIGNANT', 'RESPONSABLE ACADEMIQUE']),
        ];
    }
}