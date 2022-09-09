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
            'intitule'=>$this->faker->name(),
            'motif'=>$this->faker->text(20),
            'etat'=>$this->faker->boolean(),
            'montant'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'modePaiement'=>$this->faker->randomElement(['Cash' ,'Momo','Om','Express Union']),
            'seance_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'membre_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'retard_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'echec_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'caisse_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
