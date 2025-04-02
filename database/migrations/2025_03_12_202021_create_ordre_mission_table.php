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
        Schema::create('ordre_mission', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->date('dateAriver');
            $table->date('dateFin');
            $table->string('transport');
            $table->string('destination');
            $table->string('objectif');
            $table->unsignedBigInteger('idFonctionnaire');
            $table->string('etatRemboursement')->default('EN ATTEND')->nullable();
            $table->string('file_path');
            $table->timestamps();

            // Adding a foreign key constraint for the idFonctionnaire column
            $table->foreign('idFonctionnaire')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordre_mission');
    }
};
