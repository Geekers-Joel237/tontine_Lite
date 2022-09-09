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
            $table->string('nomT');
            $table->float('montantT');
            $table->string('slogan');
            $table->text('reglement')->nullable();
            $table->integer('maxT');
            $table->float('retard');
            $table->float('sanction');
            $table->float('echec');
            $table->string('type');
            $table->string('codeAdhesion')->nullable();
            $table->boolean('validation')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
