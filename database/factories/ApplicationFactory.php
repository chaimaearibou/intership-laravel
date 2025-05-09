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
    // Get an 'interne' with a candidat profile
    $utilisateur = Utilisateur::where('role', 'interne')
        ->whereHas('candidat_profile') // make sure it has a profile
        ->inRandomOrder()
        ->first();

    $candidat = $utilisateur->candidat_profile;

    $offre = Offre::inRandomOrder()->first() ?? Offre::factory()->create();

    // Generate fake CV and lettre files
    $cvName = 'cv_' . Str::random(10) . '.pdf';
    Storage::disk('public')->put("cv/$cvName", 'Fake CV content');

    $lettreName = 'lettre_' . Str::random(10) . '.pdf';
    Storage::disk('public')->put("lettres/$lettreName", 'Fake lettre content');

    return [
        'statut' => $this->faker->randomElement(['pending', 'accept', 'refuse']),
        'applied_at' => $this->faker->dateTime(),
        'candidat_id' => $candidat->candidat_id,
        'offre_id' => $offre->offre_id,
        'utilisateur_id' => $utilisateur->utilisateur_id,
        'cv' => "cv/$cvName",
        'lettre_motivation' => "lettres/$lettreName",
    ];
}


}
