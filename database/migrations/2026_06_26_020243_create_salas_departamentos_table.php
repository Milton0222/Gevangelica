<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salas_departamentos', function (Blueprint $table) {

            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->text('finalidade')->nullable();

            $table->unsignedBigInteger('sala_id');
            $table->unsignedBigInteger('depa_id');

            $table->foreign('sala_id')->references('id')->on('salas')->onUpdate('cascade');
            $table->foreign('depa_id')->references('id')->on('departamentos')->onUpdate('cascade');

            $table->primary(['sala_id','depa_id']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salas_departamentos');
    }
};
