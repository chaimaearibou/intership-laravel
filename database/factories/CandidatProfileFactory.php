<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidat_profile>
 */
class CandidatProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'nom_candidat' => $this->faker->lastName(),
            'prenom_candidat' => $this->faker->firstName(),
            'statut' => $this->faker->randomElement(['en_attente', 'accepte', 'refuse']),
            'number' => $this->faker->phoneNumber(),
            'cv' => $this->faker->filePath(), // Assuming you have a method to generate a file path
            'lettre_motivation' => $this->faker->filePath(), // Assuming you have a method to generate a file path
            'utilisateur_id'=>Utilisateur::factory(), // Assuming you have a UtilisateurFactory
        ];
    }
}
