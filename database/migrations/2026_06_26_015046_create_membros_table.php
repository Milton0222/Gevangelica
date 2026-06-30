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
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('nome',50);
            $table->string('morada',50)->nullable();
            $table->string('telefone',9)->unique();
            $table->enum('estado_civil',['Casado','Solteiro','Viuvo','Divorciado'])->default('Solteiro');
            $table->enum('genero',['M','F']);
            $table->date('data_nascimento');
            $table->date('data_batismo')->nullable();
            $table->enum('situacao',['Transferido','Activo']);
            $table->string('cargo',50)->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros');
    }
};
