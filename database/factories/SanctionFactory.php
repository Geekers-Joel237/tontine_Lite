<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sanction>
 */
class SanctionFactory extends Factory
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
            'motif'=>$this->faker->title(),
            'dateSanction'=>$this->faker->date('Y-m-d'),
            'montantSanction'=>$this->faker->numberBetween($min = 1, $max = 50000),
            'user_id'=>$this->faker->numberBetween($min = 1, $max = 100),

        ];
    }
}
