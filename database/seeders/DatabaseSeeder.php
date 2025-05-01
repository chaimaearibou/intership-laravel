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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Utilisateur::factory()->count(10)->create();
        Offre::factory()->count(5)->create();
        application::factory()->count(10)->create();
        CandidatProfile::factory()->count(10)->create();
        Notification::factory()->count(15)->create();
    }
}
