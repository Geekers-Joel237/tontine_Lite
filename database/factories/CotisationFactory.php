<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cotisation>
 */
class CotisationFactory extends Factory
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
            'nomCotisation'=>$this->faker->firstName(),
            'motif'=>$this->faker->name(),
            'etat'=>$this->faker->boolean(),
            'montant'=>$this->faker->numberBetween($min = 1, $max = 1000000),
            'classement'=>$this->faker->numberBetween($min = 1, $max = 100),
            'user_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'seance_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'tontine_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
