<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evenement>
 */
class EvenementFactory extends Factory
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
            'titre'=>$this->faker->title,
            'dateEvenement'=>$this->faker->date($format = 'Y-m-d'),
            'image'=>$this->faker->title,
            'texte'=>$this->faker->text
        ];
    }
}
