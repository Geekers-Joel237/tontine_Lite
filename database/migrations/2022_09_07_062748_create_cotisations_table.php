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
            $table->string('intitule');
            $table->string('motif');
            $table->boolean('etat');
            $table->float('montant');
            $table->string('modePaiement');
            $table->foreignId('seance_id')->constrained('seances')->onDelete('cascade');
            $table->foreignId('membre_id')->constrained('membres')->onDelete('cascade');
            $table->foreignId('retard_id')->nullable()->constrained('retards')->onDelete('cascade');
            $table->foreignId('echec_id')->nullable()->constrained('echecs')->onDelete('cascade');
            $table->foreignId('caisse_id')->nullable()->constrained('caisses')->onDelete('cascade');
            $table->foreignId('tontine_id')->nullable()->constrained('tontines')->onDelete('cascade');
            $table->foreignId('exercice_id')->nullable()->constrained('exercices')->onDelete('cascade');
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
