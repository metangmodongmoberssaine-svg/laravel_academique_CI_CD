<?php

namespace Database\Factories;

use App\Models\Personnel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    protected $model = Personnel::class;

    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'code_pers' => $this->faker->unique()->bothify('PERS###'),
            'nom_pers' => $this->faker->name,
            'sexe_pers' => $this->faker->randomElement(['Masculin', 'Feminin']),
            'phone_pers' => $this->faker->unique()->phoneNumber(),
            'login_pers' => $this->faker->unique()->safeEmail(),
            'pwd_pers' => Hash::make('password'),
            'type_pers' => $this->faker->randomElement(['RESPONSABLE DISCIPLINE', 'ENSEIGNANT', 'RESPONSABLE ACADEMIQUE']),
        ];
    }
}