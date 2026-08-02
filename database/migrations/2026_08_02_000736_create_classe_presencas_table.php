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
        Schema::create('classe_presencas', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo',['P','F']);
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('membro_id');

            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('membro_id')->references('id')->on('membros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_presencas');
    }
};
