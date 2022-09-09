<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercice>
 */
class ExerciceFactory extends Factory
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
            'nomE'=>$this->faker->name(),
            'periodicite'=>$this->faker->randomElement(['7Jours' ,'1Mois','1Semaine','1Annee']),
            'dateDebutE'=>$this->faker->date($format = 'Y-m-d'),
            'dateFinE'=>$this->faker->date($format = 'Y-m-d'),
            'heureTontine'=>$this->faker->time(),
            'statusE'=>$this->faker->boolean(),
            'etatE'=>$this->faker->boolean(),
            'tontine_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
