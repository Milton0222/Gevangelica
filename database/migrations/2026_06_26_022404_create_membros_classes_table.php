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
        Schema::create('membros_classes', function (Blueprint $table) {
            $table->unsignedBigInteger('membro_id');
            $table->unsignedBigInteger('classe_id');

             $table->foreign('membro_id')->references('id')->on('membros')->onUpdate('cascade');
             $table->foreign('classe_id')->references('id')->on('classes')->onUpdate('cascade');

             $table->primary(['membro_id','classe_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros_classes');
    }
};
