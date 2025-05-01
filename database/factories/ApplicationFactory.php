<?php

namespace Database\Factories;

use App\Models\Offre;
use App\Models\Utilisateur;
use App\Models\CandidatProfile;
use Illuminate\Validation\Rules\Can;
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
        return [
            'statut' => $this->faker->randomElement(['en_attente', 'accepte', 'refuse']),
            'applied_at' => $this->faker->dateTime(),
            'candidat_id'=>CandidatProfile::factory(), // Assuming you have a CandidateProfileFactory
            'offre_id'=>Offre::factory(),
            'utilisateur_id'=>Utilisateur::factory(),
        ];
    }
}
