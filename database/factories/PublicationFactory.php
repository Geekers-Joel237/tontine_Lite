<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
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
            'user_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'reunion_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'evenement_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'annonce_id'=>$this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
