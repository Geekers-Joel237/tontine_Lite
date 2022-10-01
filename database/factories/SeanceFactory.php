<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seance>
 */
class SeanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'nomS'=>$this->faker->name(),
            'dateS'=>$this->faker->date($format = 'Y-m-d'),
            'statutS'=>$this->faker->boolean(),
            'etatS'=>$this->faker->boolean(),
            // 'frequence'=>$this->faker->numberBetween($min = 1, $max = 30),
            'exercice_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
