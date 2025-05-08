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
use App\Models\Candidat_profile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
   // This will create 2 admins and 3 internes as per your factory logic
    Utilisateur::factory()->count(5)->create();

    // Get one admin to be used as the creator of offers
    $admin = Utilisateur::where('role', 'admin')->first();

    // Create offers and assign to that admin
    if ($admin) {
        // Create 5 offers and assign to the admin
        Offre::factory()->count(5)->create([
            'creer_par' => $admin->utilisateur_id, 
        ]);
    }

    // Other data
    Application::factory()->count(10)->create();
    CandidatProfile::factory()->count(10)->create();
    Notification::factory()->count(15)->create();
    }
}
