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
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            $table->date('dateIntegration');
            $table->string('statutMembre')->default('Membre');
            $table->boolean('estActif')->default(true);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('exercice_id')->nullabe()->constrained('exercices')->onDelete('cascade');
            $table->foreignId('tontine_id')->constrained('tontines')->onDelete('cascade');
            $table->foreignId('demande_id')->constrained('demandes')->onDelete('cascade');
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
        Schema::dropIfExists('membres');
    }
};
