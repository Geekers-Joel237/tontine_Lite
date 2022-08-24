<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reunion>
 */
class ReunionFactory extends Factory
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
            'nomReunion'=>$this->faker->name(),
            'codeAdhesion'=>$this->faker->uuid,
            'reglement'=>$this->faker->text(),
            'slogan'=>$this->faker->text(50),
            'maxEffectif'=>$this->faker->numberBetween($min = 1, $max = 100),
            'user_id'=>$this->faker->numberBetween($min = 1, $max = 100),

        ];
    }
}
