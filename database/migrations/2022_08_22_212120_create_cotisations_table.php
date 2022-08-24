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
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->string('nomCotisation');
            $table->string('motif');
            $table->float('montant');
            $table->boolean('etat');
            $table->integer('classement');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('seance_id')->constrained('seances');
            $table->foreignId('tontine_id')->constrained('tontines');
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
        Schema::dropIfExists('cotisations');
    }
};
