<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FichierFactory extends Factory
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
            'nomFichier'=>$this->faker->text(50)                          ,
            'filePath'=>$this->faker->text(50)                          ,
            'extension'=>$this->faker->text(50)                          ,
            'user_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'evenement_id'=>$this->faker->numberBetween($min = 1, $max = 100),
            'rapport_id'=>$this->faker->numberBetween($min = 1, $max = 100),

        ];
    }
}
