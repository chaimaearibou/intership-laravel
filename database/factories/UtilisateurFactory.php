<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
     // Arabic names (first and last)
     protected static $arabicFirstNames = [
        'Ahmad', 'Fatima', 'Omar', 'Amina', 'Youssef', 'Salma', 'Khalid', 'Zahra'
    ];

    protected static $arabicLastNames = [
        'Benali', 'El Amrani', 'Alami', 'Toumi', 'Chakib', 'Boukadoum', 'Hamdi', 'Nassiri'
    ];

    protected static $adminCount = 0;

    public function definition(): array
    {
        // 4 letters + 4 digits password
        $letters = $this->faker->lexify('????');
        $numbers = $this->faker->numerify('####');
        $password = strtolower($letters) . $numbers;

        // Role logic: only assign 'admin' to first 2 created users
        $role = self::$adminCount < 2 ? 'admin' : 'interne';
        if ($role === 'admin') {
            self::$adminCount++;
        }

        return [
            'nom' => $this->faker->randomElement(self::$arabicLastNames),
            'prenom' => $this->faker->randomElement(self::$arabicFirstNames),
            'email' => $this->faker->unique()->safeEmail(),
            'mot_de_passe' => $password,
            'role' => $role,
        ];
    }
}
