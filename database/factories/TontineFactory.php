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
            'nomT'=>$this->faker->name(),
            'montantT'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'slogan'=>$this->faker->text(50),
            'reglement'=>$this->faker->text(50),
            'maxT'=>$this->faker-> numberBetween($min = 1, $max = 100),
            'retard'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'sanction'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'echec'=>$this->faker->numberBetween($min = 5000, $max = 100000),
            'type'=>$this->faker->randomElement(['Fermee' ,'Ouverte']),
            'codeAdhesion'=>$this->faker->text(10),
            'validation'=>$this->faker->boolean(),
            'user_id'=>$this->faker->numberBetween($min = 1, $max = 100)

        ];
    }
}
