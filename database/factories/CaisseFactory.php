<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Caisse>
 */
class CaisseFactory extends Factory
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
            'nomC'=>$this->faker->name(),
            'solde'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'tontine_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
