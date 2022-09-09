<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dette>
 */
class DetteFactory extends Factory
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
            'montant'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'modePaiement'=>$this->faker->randomElement(['Cash' ,'Momo','Om','Express Union']),
            'status'=>$this->faker->boolean(),
            'tontine_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'exercice_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'membre_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'retard_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'echec_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'caisse_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'cotisation_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
