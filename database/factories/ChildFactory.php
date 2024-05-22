<?php

namespace Database\Factories;

use App\Models\Studiekeuze;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds=User::pluck('id')->toArray();
        $studiekeuzeIds=Studiekeuze::pluck('id')->toArray();
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'is_active' => true,
            'studiekeuze_id' => fake()->randomElement($studiekeuzeIds),
            'user_id' => fake()->randomElement($userIds),

        ];
    }
}
