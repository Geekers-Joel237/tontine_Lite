<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Annonce::factory(100)->create();
        \App\Models\Cotisation::factory(100)->create();
        \App\Models\CotisationEvenement::factory(100)->create();
        \App\Models\Evenement::factory(100)->create();
        \App\Models\Fichier::factory(100)->create();
        \App\Models\Integration::factory(100)->create();
        \App\Models\Publication::factory(100)->create();
        \App\Models\Rapport::factory(100)->create();
        \App\Models\Reunion::factory(100)->create();
        \App\Models\Sanction::factory(100)->create();
        \App\Models\Seance::factory(100)->create();
        \App\Models\Tontine::factory(100)->create();
        \App\Models\User::factory(100)->create();


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
