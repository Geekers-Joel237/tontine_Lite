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
            // 'nomE'=>$this->faker->name(),
            'frequence'=>$this->faker->numberBetween($min = 1, $max = 100),
            'dateDebutE'=>$this->faker->date($format = 'Y-m-d'),
            'duree'=>$this->faker->numberBetween($min = 1, $max = 100),
            'periodicite'=>$this->faker->randomElement(['Jour' ,'Mois','Semaine','Annee']),
            'heureTontine'=>$this->faker->time(),
            'lieuTontine'=>$this->faker->randomElement(['Biteng' ,'Yassa','Kabul','Emia']),
            'statusE'=>$this->faker->boolean(),
            'etatE'=>$this->faker->boolean(),
            'tontine_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
