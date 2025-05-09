<?php

namespace Database\Factories;

use App\Models\application;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
 public function definition(): array
{
    // Get a random application (or create one if none exist)
    $application = \App\Models\application::inRandomOrder()->first();

    if (!$application) {
        $application = \App\Models\application::factory()->create();
    }

    return [
        'message' => $this->faker->sentence(),
        'type' => $this->faker->randomElement(['info', 'warning', 'error']),
        'lue' => $this->faker->boolean(),
        'utilisateur_id' => $application->utilisateur_id, // Match the user who made the application
        'application_id' => $application->application_id,
    ];
}

}
