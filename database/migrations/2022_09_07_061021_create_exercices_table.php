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
        Schema::create('exercices', function (Blueprint $table) {
            $table->id();
            // $table->string('nomE');
            $table->string('periodicite');
            $table->float('frequence');
            $table->date('dateDebutE');
            $table->float('duree');
            $table->time('heureTontine');
            $table->string('lieuTontine');
            $table->integer('nbreBenef');
            $table->boolean('statusE')->default(true);
            $table->boolean('etatE')->default(false);
            $table->foreignId('tontine_id')->constrained('tontines')->onDelete('cascade');
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
        Schema::dropIfExists('exercices');
    }
};
