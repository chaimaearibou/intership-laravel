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
        $utilisateur = Utilisateur::factory()->create([
            'role' => 'interne',
        ]);
    
        return [
            'nom_candidat' => $utilisateur->nom,
            'prenom_candidat' => $utilisateur->prenom,
            'number' => $this->faker->phoneNumber(),
            'statut' => $this->faker->randomElement(['actif', 'inactif']),
            'utilisateur_id' => $utilisateur->utilisateur_id,
            'photo' => 'https://i.pravatar.cc/300?img=' . rand(1, 70),
        ];
    }
}
