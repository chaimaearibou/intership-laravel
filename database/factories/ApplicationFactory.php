<?php

namespace Database\Factories;

use App\Models\Offre;
use App\Models\Utilisateur;
use Illuminate\Support\Str;
use App\Models\CandidatProfile;
use Illuminate\Validation\Rules\Can;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cvName = 'cv_' . Str::random(10) . '.pdf';
        Storage::disk('public')->put("cv/$cvName", 'Fake CV content');
    
        // Generate fake Lettre de motivation
        $lettreName = 'lettre_' . Str::random(10) . '.pdf';
        Storage::disk('public')->put("lettres/$lettreName", 'Fake lettre content');
        
        return [
            'statut' => $this->faker->randomElement(['pending', 'accept', 'refuse']),
            'applied_at' => $this->faker->dateTime(),
            'candidat_id'=>CandidatProfile::factory(), // Assuming you have a CandidateProfileFactory
            'offre_id'=>Offre::factory(),
            'utilisateur_id'=>Utilisateur::factory(),
            'cv' =>"cv/$cvName", // Assuming you have a method to generate a file path
            'lettre_motivation' => "lettres/$lettreName", // Assuming you have a method to generate a file path
        ];
    }
}
