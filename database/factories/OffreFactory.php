<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        // Predefined IT internship titles
        $titles = [
            'Web Developer Intern',
            'Mobile App Developer Intern',
            'Data Analyst Intern',
            'Network Engineer Intern',
            'UI/UX Designer Intern'
        ];

        // Cities
        $cities = ['Hoceima', 'Tétouan', 'M\'diq', 'Tanger'];

        // Randomly select a title
        $titre = $this->faker->randomElement($titles);

        // Duration in months (1 to 6)
        $duration = $this->faker->numberBetween(1, 6);

        // Start date: between today and +1 month
        $startDate = Carbon::now()->addDays(rand(0, 30))->startOfDay();

        // End date: start date + duration in months
        $endDate = (clone $startDate)->addMonths($duration);

        return [
            'titre' => $titre,
            'description' => "This is a {$duration}-month internship for the position of {$titre}, where the intern will gain hands-on experience.",
            'localisation' => $this->faker->randomElement($cities),
            'duration' => $duration,
            'creer_par' => Utilisateur::factory(),
            'creer_at' => now(),
            'date_debut' => $startDate->toDateString(),
            'date_fin' => $endDate->toDateString(),
            'type' => $this->faker->randomElement(['remote', 'hybride', 'on-site']),
        ];
    }
}
