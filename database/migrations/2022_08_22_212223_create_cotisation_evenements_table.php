<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotisation_evenements', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->string('motif');
            $table->boolean('etat');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('reunion_id')->constrained('reunions');
            $table->foreignId('evenement_id')->constrained('evenements');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotisation_evenements');
    }
};
