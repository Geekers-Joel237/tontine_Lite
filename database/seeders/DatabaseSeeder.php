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
        \App\Models\Tontine::factory(100)->create();
        \App\Models\Exercice::factory(100)->create();
        \App\Models\Seance::factory(100)->create();
        \App\Models\Caisse::factory(100)->create();
        \App\Models\Beneficiaire::factory(100)->create();
        \App\Models\Cotisation::factory(100)->create();
        \App\Models\Dette::factory(100)->create();


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
