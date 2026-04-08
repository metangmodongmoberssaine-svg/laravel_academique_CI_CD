<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\Ue;
use App\Models\Ec;
use App\Models\Personnel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Vider les tables avant de remplir (alternative à wipe)
        Filiere::truncate();
        Niveau::truncate();
        Ue::truncate();
        Ec::truncate();
        Personnel::truncate();
        
        // 1. Créer une filière
        $filiere = Filiere::create([
            'code_filiere' => 'INFO',
            'label_filiere' => 'Informatique',
            'desc_filiere' => 'Filière informatique'
        ]);
        
        // 2. Créer un niveau
        $niveau = Niveau::create([
            'code_niveau' => 1,
            'label_niveau' => 'Licence 1',
            'desc_niveau' => 'Première année',
            'code_filiere' => 'INFO'
        ]);
        
        // 3. Créer une UE
        $ue = Ue::create([
            'code_ue' => 'UE001',
            'label_ue' => 'Programmation Web',
            'desc_ue' => 'Introduction au développement web',
            'code_niveau' => 1
        ]);
        
        // 4. Créer un EC
        Ec::create([
            'code_ec' => 'EC001',
            'label_ec' => 'PHP et Laravel',
            'desc_ec' => 'Développement backend avec Laravel',
            'nbh_ec' => 30,
            'nbc_ec' => 3,
            'code_ue' => 'UE001'
        ]);
        
        // 5. Créer un personnel
        Personnel::create([
            'id' => (string) Str::uuid(),
            'code_pers' => 'ADMIN001',
            'nom_pers' => 'Administrateur',
            'sexe_pers' => 'Masculin',
            'phone_pers' => '771234567',
            'login_pers' => 'admin@test.com',
            'pwd_pers' => Hash::make('password'),
            'type_pers' => 'ENSEIGNANT'
        ]);
        
        $this->command->info('Base de données remplie avec succès !');
    }
}