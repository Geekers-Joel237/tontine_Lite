<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tontine>
 */
class TontineFactory extends Factory
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
            'intitule'=>$this->faker->title,
            'monnaie'=>$this->faker->randomElement(['XAF' ,'EUR','DS']),
            'modePaiement'=>$this->faker->randomElement(['Cash' ,'OM','Momo']),
            'reglement'=>$this->faker->text(),
            'numeroCompte'=>$this->faker->creditCardNumber,
            'effectifMax'=>$this->faker-> numberBetween($min = 1, $max = 100),
            'montant'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'reunion_id'=>$this->faker->numberBetween($min = 1, $max = 100)

        ];
    }
}
