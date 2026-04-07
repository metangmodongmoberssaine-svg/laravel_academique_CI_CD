<?php

namespace Tests\Feature;

use App\Models\Ec;
use App\Models\Personnel;
use App\Models\Programmation;
use App\Models\Salle;
use App\Models\Ue;
use App\Models\Filiere;
use App\Models\Niveau;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\ApiTokenTrait;

class ProgrammationTest extends TestCase
{
    use ApiTokenTrait, RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function can_list_programmations()
    {
        $this->authenticatePersonnel();
        
        // Créer les dépendances
        $filiere = Filiere::factory()->create();
        $niveau = Niveau::factory()->create(['code_filiere' => $filiere->code_filiere]);
        $ue = Ue::factory()->create(['code_niveau' => $niveau->code_niveau]);
        $ec = Ec::factory()->create(['code_ue' => $ue->code_ue]);
        $salle = Salle::factory()->create();
        
        // Créer un personnel avec une valeur FORCÉE pour code_pers
        $personnel = Personnel::create([
            'id' => (string) Str::uuid(),
            'code_pers' => 'PERS_FORCE_001',
            'nom_pers' => 'Test User',
            'sexe_pers' => 'Masculin',
            'phone_pers' => '123456789',
            'login_pers' => 'force@test.com',
            'pwd_pers' => Hash::make('password'),
            'type_pers' => 'ENSEIGNANT',
        ]);
        
        // Créer 3 programmations
        for ($i = 0; $i < 3; $i++) {
            Programmation::create([
                'id' => Str::uuid(),
                'code_ec' => $ec->code_ec,
                'num_salle' => $salle->num_salle,
                'code_pers' => $personnel->code_pers,
                'date' => now()->addDays($i)->format('Y-m-d'),
                'heure_debut' => '08:00',
                'heure_fin' => '10:00',
                'nbre_heure' => 2,
                'status' => 'Programmé',
            ]);
        }

        $response = $this->getJson('/api/programmations');
        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function can_create_programmation()
    {
        $this->authenticatePersonnel();
        
        // Créer les dépendances
        $filiere = Filiere::factory()->create();
        $niveau = Niveau::factory()->create(['code_filiere' => $filiere->code_filiere]);
        $ue = Ue::factory()->create(['code_niveau' => $niveau->code_niveau]);
        $ec = Ec::factory()->create(['code_ue' => $ue->code_ue]);
        $salle = Salle::factory()->create();
        
        // Créer un personnel avec une valeur FORCÉE
        $personnel = Personnel::create([
            'id' => (string) Str::uuid(),
            'code_pers' => 'PERS_FORCE_002',
            'nom_pers' => 'Test User 2',
            'sexe_pers' => 'Feminin',
            'phone_pers' => '987654321',
            'login_pers' => 'force2@test.com',
            'pwd_pers' => Hash::make('password'),
            'type_pers' => 'ENSEIGNANT',
        ]);

        $payload = [
            'code_ec' => $ec->code_ec,
            'num_salle' => $salle->num_salle,
            'code_pers' => $personnel->code_pers,
            'date' => now()->addDay()->format('Y-m-d'),
            'heure_debut' => '08:00',
            'heure_fin' => '10:00',
            'nbre_heure' => 2,
            'status' => 'Programmé',
        ];

        $response = $this->postJson('/api/programmations', $payload);
        $response->assertStatus(201);
        
        // Vérifier que la programmation a bien été créée
        $this->assertDatabaseHas('programmations', [
            'code_ec' => $ec->code_ec,
            'num_salle' => $salle->num_salle,
            'code_pers' => $personnel->code_pers,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function can_show_specific_programmation()
    {
        $this->authenticatePersonnel();
        
        // Créer les dépendances
        $filiere = Filiere::factory()->create();
        $niveau = Niveau::factory()->create(['code_filiere' => $filiere->code_filiere]);
        $ue = Ue::factory()->create(['code_niveau' => $niveau->code_niveau]);
        $ec = Ec::factory()->create(['code_ue' => $ue->code_ue]);
        $salle = Salle::factory()->create();
        
        // Créer un personnel avec une valeur FORCÉE
        $personnel = Personnel::create([
            'id' => (string) Str::uuid(),
            'code_pers' => 'PERS_FORCE_003',
            'nom_pers' => 'Test User 3',
            'sexe_pers' => 'Masculin',
            'phone_pers' => '555555555',
            'login_pers' => 'force3@test.com',
            'pwd_pers' => Hash::make('password'),
            'type_pers' => 'RESPONSABLE DISCIPLINE',
        ]);
        
        // Créer une programmation
        $programmation = Programmation::create([
            'id' => Str::uuid(),
            'code_ec' => $ec->code_ec,
            'num_salle' => $salle->num_salle,
            'code_pers' => $personnel->code_pers,
            'date' => now()->addDay()->format('Y-m-d'),
            'heure_debut' => '08:00',
            'heure_fin' => '10:00',
            'nbre_heure' => 2,
            'status' => 'Programmé',
        ]);

        $response = $this->getJson("/api/programmations/{$programmation->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $programmation->id);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function can_update_programmation()
    {
        $this->authenticatePersonnel();
        
        // Créer les dépendances
        $filiere = Filiere::factory()->create();
        $niveau = Niveau::factory()->create(['code_filiere' => $filiere->code_filiere]);
        $ue = Ue::factory()->create(['code_niveau' => $niveau->code_niveau]);
        $ec = Ec::factory()->create(['code_ue' => $ue->code_ue]);
        $salle = Salle::factory()->create();
        
        // Créer un personnel avec une valeur FORCÉE
        $personnel = Personnel::create([
            'id' => (string) Str::uuid(),
            'code_pers' => 'PERS_FORCE_004',
            'nom_pers' => 'Test User 4',
            'sexe_pers' => 'Feminin',
            'phone_pers' => '444444444',
            'login_pers' => 'force4@test.com',
            'pwd_pers' => Hash::make('password'),
            'type_pers' => 'RESPONSABLE ACADEMIQUE',
        ]);
        
        // Créer une programmation
        $programmation = Programmation::create([
            'id' => Str::uuid(),
            'code_ec' => $ec->code_ec,
            'num_salle' => $salle->num_salle,
            'code_pers' => $personnel->code_pers,
            'date' => now()->addDay()->format('Y-m-d'),
            'heure_debut' => '08:00',
            'heure_fin' => '10:00',
            'nbre_heure' => 2,
            'status' => 'Programmé',
        ]);

        $response = $this->putJson("/api/programmations/{$programmation->id}", [
            'status' => 'Terminé',
        ]);

        $response->assertStatus(200);
        
        // Vérifier que le statut a bien été mis à jour de programmations
        $this->assertDatabaseHas('programmations', [
            'id' => $programmation->id,
            'status' => 'Terminé',
        ]);
    }
}