<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beneficiaire>
 */
class BeneficiaireFactory extends Factory
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
            'dateSeance'=>$this->faker->date($format = 'Y-m-d'),
            'classement'=>$this->faker->numberBetween($min = 1, $max = 100),
            'montant'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'validation'=>$this->faker->boolean(),
            'membre_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'seance_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'exercice_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
