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
        Schema::create('fichiers', function (Blueprint $table) {
            $table->id();
            $table->string('fileName');
            $table->string('filePath');
            $table->string('extension');
            $table->string('type');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tontine_id')->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
            $table->foreign('tontine_id')->references('id')
            ->on('tontines')->onDelete('cascade');
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
        Schema::dropIfExists('fichiers');
    }
};
