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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',50);
            $table->string('tipo',20);
            $table->date('data');
            $table->string('local')->nullable();
            $table->time('hora')->nullable();
            $table->enum('estado',['Pendente','Realizado','Cancelado']);
            $table->text('finalidade')->nullable();
            $table->string('tema',50)->nullable();

            $table->unsignedBigInteger('depa_id')->nullable();
            $table->foreign('depa_id')->references('id')->on('departamentos')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
