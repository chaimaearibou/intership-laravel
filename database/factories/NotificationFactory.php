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
        return [
            'message' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['info', 'warning', 'error']),
            'lue' => $this->faker->boolean(),
            'utilisateur_id' => Utilisateur::factory(), // Assuming you have a UtilisateurFactory
            'application_id' => application::factory(), // Assuming you have an ApplicationFactory
        ];
    }
}
