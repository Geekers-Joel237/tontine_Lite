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
        Schema::create('tontines', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->string('monnaie');
            $table->string('modePaiement');
            $table->text('reglement');
            $table->string('numeroCompte');
            $table->Integer('effectifMax');
            $table->float('montant');
            $table->foreignId('reunion_id')->nullable()->constrained('reunions');
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
        Schema::dropIfExists('tontines');
    }
};
