<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offre>
 */
class OffreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'localisation' => $this->faker->city(),
            'duration' => $this->faker->numberBetween(1,6), // Duration in months
            'creer_par'=>Utilisateur::factory(), // Assuming you have a UtilisateurFactory
            'creer_at' => $this->faker->dateTime(),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->dateTimeBetween('now', '+1 year'), // Date between now and one year from now
            'type' => $this->faker->randomElement(['remote', 'hybride', 'on-site']), 
            //
        ];
    }
}
