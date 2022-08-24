<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Integration>
 */
class IntegrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'dateIntegration'=>$this->faker->date($format = 'Y-m-d'),
            'statutMembre'=>$this->faker->randomElement(['Membre' ,'Admin']),
            'user_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'reunion_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
