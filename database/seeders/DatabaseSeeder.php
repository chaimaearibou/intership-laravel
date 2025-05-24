<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Offre;
use App\Models\application;
use App\Models\Utilisateur;
use App\Models\Notification;
use App\Models\CandidatProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
  //  Create fixed admin
        $admin = Utilisateur::create([
            'nom' => 'Admin',
            'prenom' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        //  Create fixed interne
        $interne = Utilisateur::create([
            'nom' => 'Interne',
            'prenom' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'role' => 'interne',
        ]);

        // Create 5 more internes
        $internes = Utilisateur::factory(5)->create();

        // Create CandidatProfiles for each interne
        foreach ($internes->concat([$interne]) as $utilisateur) {
    CandidatProfile::factory()->create([
        'utilisateur_id' => $utilisateur->utilisateur_id,
        'nom_candidat' => $utilisateur->nom,
        'prenom_candidat' => $utilisateur->prenom,
    ]);
}


        // Create 5 offers and assign to the fixed admin
        Offre::factory()->count(5)->create([
            'creer_par' => $admin->utilisateur_id,
        ]);

    // Other data
    Application::factory()->count(5)->create();
    // CandidatProfile::factory()->count(5)->create();
    Notification::factory()->count(5)->create();
    }
}
