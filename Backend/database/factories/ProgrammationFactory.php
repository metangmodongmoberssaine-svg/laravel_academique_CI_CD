<?php

namespace Database\Factories;

use App\Models\Ec;
use App\Models\Personnel;
use App\Models\Programmation;
use App\Models\Salle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProgrammationFactory extends Factory
{
    protected $model = Programmation::class;

    public function definition(): array
    {
        $heureDebut = $this->faker->time('H:i');
        $heureFin = date('H:i', strtotime($heureDebut . ' +2 hours'));

        return [
            'id' => (string) Str::uuid(),
            'code_ec' => Ec::factory(),
            'num_salle' => Salle::factory(),
            'code_pers' => Personnel::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'heure_debut' => $heureDebut,
            'heure_fin' => $heureFin,
            'nbre_heure' => $this->faker->numberBetween(1, 4),
            'status' => $this->faker->randomElement(['Programmé', 'Annulé', 'Terminé', 'EN ATTENTE']),
        ];
    }
}