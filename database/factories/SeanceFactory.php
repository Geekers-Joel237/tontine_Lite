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
            //
            'dateSeance'=>$this->faker->date($format = 'Y-m-d'),
            'heureSeance'=>$this->faker->time($format = 'H:i:s') ,
            'etat'=>$this->faker->randomElement(['En Cours' ,'Passee','A Venir']),
            'reunion_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
